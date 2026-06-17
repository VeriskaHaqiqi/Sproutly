// script-roomChatUser.js — Real DB Integration (No Dummy Data)

document.addEventListener('DOMContentLoaded', function () {

    // ── DB Consultation Data ──────────────────────────────────────
    const dbConsultation = window.DB_CONSULTATION;
    const csrfToken = window.CSRF_TOKEN || document.querySelector('meta[name="csrf-token"]')?.content || '';

    if (!dbConsultation) return;

    const consultationId = dbConsultation.id;
    const expert = dbConsultation.expert;
    let lastMessageId = 0;
    let pollingInterval = null;

    // ── DOM ──────────────────────────────────────────────────────────
    const messagesArea = document.getElementById('messagesArea');
    const messageInput = document.getElementById('messageInput');
    const btnSend      = document.getElementById('btnSend');
    const btnAttach    = document.getElementById('btnAttach');
    const btnEmoji     = document.getElementById('btnEmoji');
    const fileInput    = document.getElementById('fileInput');

    // ── Init ─────────────────────────────────────────────────────────
    loadMessagesFromDB();
    pollingInterval = setInterval(pollNewMessages, 3000);
    messagesArea.classList.add('visible');

    // ── Load initial messages from DB ────────────────────────────────
    function loadMessagesFromDB() {
        fetch(`/pesan/${consultationId}?after_id=0`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            messagesArea.innerHTML = '';
            if (data.data && data.data.length > 0) {
                data.data.forEach(function(msg) {
                    if (msg.pengirim === 'ahli') {
                        appendExpertBubble(expert.initials, expert.avatarBg, msg.isi_pesan, msg.waktu_kirim, msg.gambar, false);
                    } else {
                        appendUserBubble(msg.isi_pesan, msg.waktu_kirim, msg.gambar, false);
                    }
                    if (msg.id > lastMessageId) lastMessageId = msg.id;
                });
            } else {
                // Show a welcome message if no messages yet
                appendExpertBubble(
                    expert.initials, 
                    expert.avatarBg, 
                    "Hello! I'm " + expert.name + ", your " + expert.role + ". How can I help you today?", 
                    getCurrentTime(),
                    null,
                    false
                );
            }
            scrollToBottom();
        })
        .catch(err => {
            console.error('Failed to load messages:', err);
        });
    }

    // ── Poll for new messages ────────────────────────────────────────
    function pollNewMessages() {
        fetch(`/pesan/${consultationId}?after_id=${lastMessageId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.data && data.data.length > 0) {
                data.data.forEach(function(msg) {
                    if (msg.id > lastMessageId) {
                        // Only render expert messages via polling (user messages are shown optimistically)
                        if (msg.pengirim === 'ahli') {
                            appendExpertBubble(expert.initials, expert.avatarBg, msg.isi_pesan, msg.waktu_kirim, msg.gambar, true);
                        }
                        lastMessageId = msg.id;
                    }
                });
                scrollToBottom();
            }
        })
        .catch(err => {
            console.error('Polling error:', err);
        });
    }

    // ── Send message (real POST to /pesan) ───────────────────────────
    function sendMessage() {
        var text = messageInput.value.trim();
        if (!text) return;

        var time = getCurrentTime();

        // Optimistic UI — show bubble immediately
        appendUserBubble(text, time, null, true);
        messageInput.value = '';
        scrollToBottom();

        // Send to server
        var formData = new FormData();
        formData.append('konsultasi_id', consultationId);
        formData.append('isi_pesan', text);
        formData.append('_token', csrfToken);

        fetch('/pesan', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success && data.data.id > lastMessageId) {
                lastMessageId = data.data.id;
            }
        })
        .catch(function(err) {
            console.error('Failed to send message:', err);
        });
    }

    // ── DOM builders ────────────────────────────────────────────────
    function appendExpertBubble(initials, avatarBg, text, time, gambar, animate) {
        var row = document.createElement('div');
        row.classList.add('message-row', 'expert-row');
        if (!animate) row.style.animation = 'none';

        var av = document.createElement('div');
        av.classList.add('msg-avatar-initials');
        av.textContent = initials;
        av.style.background = avatarBg;

        var bubble = document.createElement('div');
        bubble.classList.add('bubble', 'expert-bubble');

        if (gambar) {
            var img = document.createElement('img');
            img.src = gambar;
            img.style.maxWidth = '200px';
            img.style.borderRadius = '8px';
            img.style.marginBottom = '6px';
            bubble.appendChild(img);
        }

        if (text) {
            var p = document.createElement('p');
            p.textContent = text;
            bubble.appendChild(p);
        }

        var t = document.createElement('span');
        t.classList.add('msg-time');
        t.textContent = time;

        bubble.appendChild(t);
        row.appendChild(av);
        row.appendChild(bubble);
        messagesArea.appendChild(row);
    }

    function appendUserBubble(text, time, gambar, animate) {
        var row = document.createElement('div');
        row.classList.add('message-row', 'user-row');
        if (!animate) row.style.animation = 'none';

        var bubble = document.createElement('div');
        bubble.classList.add('bubble', 'user-bubble');

        if (gambar) {
            var img = document.createElement('img');
            img.src = gambar;
            img.style.maxWidth = '200px';
            img.style.borderRadius = '8px';
            img.style.marginBottom = '6px';
            bubble.appendChild(img);
        }

        if (text) {
            var p = document.createElement('p');
            p.textContent = text;
            bubble.appendChild(p);
        }

        var t = document.createElement('span');
        t.classList.add('msg-time');
        t.textContent = time;

        bubble.appendChild(t);
        row.appendChild(bubble);
        messagesArea.appendChild(row);
    }

    // ── File attachment ──────────────────────────────────────────────
    if (btnAttach) {
        btnAttach.addEventListener('click', function () { fileInput.click(); });
    }

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            if (!fileInput.files || !fileInput.files.length) return;
            for (var i = 0; i < fileInput.files.length; i++) {
                var f = fileInput.files[i];
                var time = getCurrentTime();

                // Upload file
                var formData = new FormData();
                formData.append('konsultasi_id', consultationId);
                formData.append('gambar', f);
                formData.append('isi_pesan', '');
                formData.append('_token', csrfToken);

                // Optimistic preview
                var previewUrl = URL.createObjectURL(f);
                appendUserBubble('', time, previewUrl, true);
                scrollToBottom();

                fetch('/pesan', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.success && data.data.id > lastMessageId) {
                        lastMessageId = data.data.id;
                    }
                })
                .catch(function(err) { console.error('Upload failed:', err); });
            }
            fileInput.value = '';
        });
    }

    // ── Emoji picker ─────────────────────────────────────────────────
    var emojiList = ['😊','🌱','🌿','🍅','🌻','💧','🌾','🪴','🐛','🦋','🌞','🍃'];
    var emojiPicker = null;

    if (btnEmoji) {
        btnEmoji.addEventListener('click', function (e) {
            e.stopPropagation();
            if (emojiPicker) { emojiPicker.remove(); emojiPicker = null; return; }

            emojiPicker = document.createElement('div');
            emojiPicker.classList.add('emoji-picker');

            emojiList.forEach(function (em) {
                var btn = document.createElement('button');
                btn.textContent = em;
                btn.addEventListener('click', function () {
                    messageInput.value += em;
                    messageInput.focus();
                    emojiPicker.remove();
                    emojiPicker = null;
                });
                emojiPicker.appendChild(btn);
            });

            var inputBar = document.querySelector('.input-bar');
            inputBar.style.position = 'relative';
            inputBar.appendChild(emojiPicker);
        });
    }

    document.addEventListener('click', function () {
        if (emojiPicker) { emojiPicker.remove(); emojiPicker = null; }
    });

    // ── Send events ──────────────────────────────────────────────────
    if (btnSend) {
        btnSend.addEventListener('click', sendMessage);
    }
    if (messageInput) {
        messageInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
        });
    }

    // ── Helpers ──────────────────────────────────────────────────────
    function scrollToBottom() {
        setTimeout(function () { messagesArea.scrollTop = messagesArea.scrollHeight; }, 50);
    }

    function getCurrentTime() {
        var now = new Date();
        var h = now.getHours();
        var m = now.getMinutes().toString().padStart(2, '0');
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        return h + ':' + m + ' ' + ampm;
    }
});