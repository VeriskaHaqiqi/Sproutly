// public/js/chatroom.js

document.addEventListener('DOMContentLoaded', function () {

    // ── Expert data ──────────────────────────────────────────────────
    const EXPERTS = {
        marcus: {
            name:       'Dr. Marcus Chen',
            role:       'Crop Disease Specialist',
            initials:   'MC',
            avatarBg:   'linear-gradient(135deg,#76ead0,#76d7ea)',
            status:     'online',
            statusText: 'Online · Crop Disease Specialist',
            replies: [
                'Hello! I specialize in crop diseases. What symptoms are you observing on your plants?',
                'That symptom pattern is consistent with a fungal infection. Have you noticed any dark spots or white powder on the leaves?',
                'I recommend removing the affected leaves immediately to prevent further spread.',
                'You can apply a copper-based fungicide as a first treatment. Spray every 7 days for 3 weeks.',
                'Make sure to improve air circulation around the plants — overcrowding often worsens fungal disease.',
                'Good progress! Keep monitoring the plants and isolate any newly infected ones.',
                'If the infection persists after treatment, we may need to consider a systemic fungicide.',
            ],
            greeting: 'Hi! I\'m Dr. Marcus Chen, a Crop Disease Specialist. What crop issues can I help you diagnose today?',
        },
        sarah: {
            name:       'Dr. Sarah Williams',
            role:       'Soil Health Expert',
            initials:   'SW',
            avatarBg:   'linear-gradient(135deg,#d0ff99,#99ff99)',
            status:     'online',
            statusText: 'Online · Soil Health Expert',
            replies: [
                'Hello! I\'m Dr. Sarah Williams, specializing in soil health. How can I help with your farming concerns?',
                'Yellowing leaves on tomatoes can indicate several issues. Are the lower leaves affected first, or throughout the plant?',
                'That pattern suggests nitrogen deficiency. I recommend a balanced fertilizer with higher nitrogen content.',
                'Consistent watering is also key. Make sure the soil stays moist but not waterlogged.',
                'Test your soil pH — tomatoes thrive best between 6.0 and 6.8.',
                'Organic compost can greatly improve soil structure and nutrient retention.',
                'Great! With proper care, you should see improvement within 2–3 weeks.',
            ],
            greeting: 'Hello! I\'m Dr. Sarah Williams, and I specialize in soil health and nutrient management. How can I assist you today?',
        },
        james: {
            name:       'Dr. James Rodriguez',
            role:       'Pest Management',
            initials:   'JR',
            avatarBg:   'linear-gradient(135deg,#fde68a,#fbbf24)',
            status:     'away',
            statusText: 'Away · Pest Management',
            replies: [
                'Hi there! I\'m Dr. James Rodriguez. I\'ll be with you shortly — just returned from a field consultation.',
                'Can you describe the insects you\'re seeing? Size, color, and which part of the plant they\'re on would help.',
                'That sounds like aphid infestation. Check the undersides of leaves for small clustered insects.',
                'Neem oil spray is highly effective against aphids. Apply it in the evening to avoid harming beneficial insects.',
                'Introducing ladybugs to your garden is a great natural aphid predator.',
                'If the infestation is severe, a pyrethrin-based insecticide can be used as a last resort.',
                'Monitor weekly. Aphid populations can rebound quickly, especially in warm weather.',
            ],
            greeting: 'Hello! Dr. James Rodriguez here — Pest Management specialist. Sorry for the brief delay. What pest issues are you dealing with?',
        },
        emma: {
            name:       'Dr. Emma Thompson',
            role:       'Organic Farming',
            initials:   'ET',
            avatarBg:   'linear-gradient(135deg,#e2e8f0,#94a3b8)',
            status:     'offline',
            statusText: 'Offline · Organic Farming',
            replies: [
                'Hi! I\'m Dr. Emma Thompson. Even though I\'m showing as offline, I can still assist you. What can I help with?',
                'Organic farming is all about working with nature. What specific challenge are you facing?',
                'Companion planting is a wonderful technique — try planting basil near your tomatoes to repel pests naturally.',
                'Composting kitchen and garden waste creates excellent nutrient-rich soil amendment.',
                'Crop rotation every season prevents soil nutrient depletion and reduces disease buildup.',
                'Avoid synthetic pesticides — they disrupt the soil microbiome that keeps your plants healthy.',
                'A healthy soil ecosystem is your best defense against most plant problems.',
            ],
            greeting: 'Hello! I\'m Dr. Emma Thompson, an Organic Farming specialist. How can I support your sustainable farming journey today?',
        },
    };

    // ── State ────────────────────────────────────────────────────────
    // Per-room message history: { expertKey: [ {type, text, time, initials, avatarBg} ] }
    const roomHistory = { marcus: [], sarah: [], james: [], emma: [] };
    let currentExpert = 'sarah';
    let replyIndexes   = { marcus: 0, sarah: 0, james: 0, emma: 0 };
    let isTyping       = false;

    // ── DOM ──────────────────────────────────────────────────────────
    const messagesArea  = document.getElementById('messagesArea');
    const messageInput  = document.getElementById('messageInput');
    const btnSend       = document.getElementById('btnSend');
    const btnAttach     = document.getElementById('btnAttach');
    const btnEmoji      = document.getElementById('btnEmoji');
    const fileInput     = document.getElementById('fileInput');
    const headerAvatar  = document.getElementById('headerAvatar');
    const headerName    = document.getElementById('headerName');
    const headerDot     = document.getElementById('headerDot');
    const headerStatus  = document.getElementById('headerStatusText');

    // ── Init ─────────────────────────────────────────────────────────
    // Load greeting for sarah (default active room)
    loadInitialGreeting('sarah');
    renderRoom('sarah');
    updateHeader('sarah');

    // ── Sidebar click ────────────────────────────────────────────────
    document.querySelectorAll('.expert-item').forEach(function (item) {
        item.addEventListener('click', function () {
            const key = this.dataset.expert;
            if (key === currentExpert) return;
            switchRoom(key, this);
        });
    });

    function switchRoom(key, clickedItem) {
        // Update sidebar active state
        document.querySelectorAll('.expert-item').forEach(function (el) {
            el.classList.remove('active');
            // Reset status label
            const expert = EXPERTS[el.dataset.expert];
            const statusEl = el.querySelector('.expert-status');
            statusEl.className = 'expert-status ' + getStatusClass(expert.status);
            statusEl.textContent = getStatusLabel(expert);
        });

        clickedItem.classList.add('active');
        const statusEl = clickedItem.querySelector('.expert-status');
        statusEl.className = 'expert-status chatting';
        statusEl.textContent = 'Currently chatting';

        currentExpert = key;

        // Animate out
        messagesArea.classList.remove('visible');
        messagesArea.classList.add('switching');

        setTimeout(function () {
            // Load greeting if first visit
            if (roomHistory[key].length === 0) {
                loadInitialGreeting(key);
            }
            renderRoom(key);
            updateHeader(key);

            messagesArea.classList.remove('switching');
            messagesArea.classList.add('visible');
            scrollToBottom();
        }, 160);
    }

    function loadInitialGreeting(key) {
        const expert = EXPERTS[key];
        roomHistory[key].push({
            type:     'expert',
            text:     expert.greeting,
            time:     getCurrentTime(),
            initials: expert.initials,
            avatarBg: expert.avatarBg,
        });
    }

    // ── Render room ───────────────────────────────────────────────────
    function renderRoom(key) {
        messagesArea.innerHTML = '';
        roomHistory[key].forEach(function (msg) {
            if (msg.type === 'expert') {
                appendExpertBubble(msg.initials, msg.avatarBg, msg.text, msg.time, false);
            } else if (msg.type === 'user') {
                appendUserBubble(msg.text, msg.time, false);
            } else if (msg.type === 'attachment') {
                appendAttachmentBubble(msg.fileName, msg.fileMeta, msg.time, false);
            } else if (msg.type === 'system') {
                appendSystemMsg(msg.text, false);
            }
        });
        scrollToBottom();
    }

    // ── Update header ─────────────────────────────────────────────────
    function updateHeader(key) {
        const expert = EXPERTS[key];
        headerAvatar.textContent   = expert.initials;
        headerAvatar.style.background = expert.avatarBg;
        headerName.textContent     = expert.name;
        headerStatus.textContent   = expert.statusText;
        headerDot.className        = 'dot-status ' + expert.status;
    }

    // ── Send message ─────────────────────────────────────────────────
    function sendMessage() {
        const text = messageInput.value.trim();
        if (!text || isTyping) return;

        const time = getCurrentTime();
        roomHistory[currentExpert].push({ type: 'user', text: text, time: time });
        appendUserBubble(text, time, true);
        messageInput.value = '';
        scrollToBottom();
        simulateExpertReply(currentExpert);
    }

    // ── DOM builders (animate = true means new bubble, false = restore) ──
    function appendExpertBubble(initials, avatarBg, text, time, animate) {
        const row = document.createElement('div');
        row.classList.add('message-row', 'expert-row');
        if (!animate) row.style.animation = 'none';

        const av = document.createElement('div');
        av.classList.add('msg-avatar-initials');
        av.textContent    = initials;
        av.style.background = avatarBg;

        const bubble = document.createElement('div');
        bubble.classList.add('bubble', 'expert-bubble');

        const p = document.createElement('p');
        p.textContent = text;

        const t = document.createElement('span');
        t.classList.add('msg-time');
        t.textContent = time;

        bubble.appendChild(p);
        bubble.appendChild(t);
        row.appendChild(av);
        row.appendChild(bubble);
        messagesArea.appendChild(row);
    }

    function appendUserBubble(text, time, animate) {
        const row = document.createElement('div');
        row.classList.add('message-row', 'user-row');
        if (!animate) row.style.animation = 'none';

        const bubble = document.createElement('div');
        bubble.classList.add('bubble', 'user-bubble');

        const p = document.createElement('p');
        p.textContent = text;

        const t = document.createElement('span');
        t.classList.add('msg-time');
        t.textContent = time;

        bubble.appendChild(p);
        bubble.appendChild(t);
        row.appendChild(bubble);
        messagesArea.appendChild(row);
    }

    function appendAttachmentBubble(fileName, fileMeta, time, animate) {
        const row = document.createElement('div');
        row.classList.add('message-row', 'user-row');
        if (!animate) row.style.animation = 'none';

        const card = document.createElement('div');
        card.classList.add('attachment-card');
        card.innerHTML = `
            <div class="attachment-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <div class="attachment-info">
                <p class="attachment-name">${escapeHtml(fileName)}</p>
                <p class="attachment-meta">${escapeHtml(fileMeta)}</p>
            </div>
            <button class="attachment-download" title="Download">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            </button>
        `;

        const t = document.createElement('span');
        t.classList.add('msg-time', 'attachment-time');
        t.textContent = time;

        row.appendChild(card);
        row.appendChild(t);
        messagesArea.appendChild(row);
    }

    function appendSystemMsg(text, animate) {
        const div = document.createElement('div');
        div.classList.add('system-msg');
        if (!animate) div.style.animation = 'none';
        div.textContent = text;
        messagesArea.appendChild(div);
    }

    // ── Expert reply simulation ───────────────────────────────────────
    function simulateExpertReply(expertKey) {
        isTyping = true;
        btnSend.disabled = true;
        btnSend.style.opacity = '.5';

        // Typing indicator
        const typingRow = buildTypingRow(EXPERTS[expertKey]);
        messagesArea.appendChild(typingRow);
        scrollToBottom();

        const delay = 1100 + Math.random() * 900;

        setTimeout(function () {
            // Only reply if still in the same room
            typingRow.remove();
            isTyping = false;
            btnSend.disabled = false;
            btnSend.style.opacity = '1';

            const expert  = EXPERTS[expertKey];
            const replies = expert.replies;
            const idx     = replyIndexes[expertKey] % replies.length;
            replyIndexes[expertKey]++;
            const text = replies[idx];
            const time = getCurrentTime();

            // Save to history
            roomHistory[expertKey].push({
                type:     'expert',
                text:     text,
                time:     time,
                initials: expert.initials,
                avatarBg: expert.avatarBg,
            });

            // Only render if still viewing this room
            if (currentExpert === expertKey) {
                appendExpertBubble(expert.initials, expert.avatarBg, text, time, true);
                scrollToBottom();
            }
        }, delay);
    }

    function buildTypingRow(expert) {
        const row = document.createElement('div');
        row.classList.add('message-row', 'expert-row');
        row.id = 'typingRow';

        const av = document.createElement('div');
        av.classList.add('msg-avatar-initials');
        av.textContent    = expert.initials;
        av.style.background = expert.avatarBg;

        const bubble = document.createElement('div');
        bubble.classList.add('bubble', 'expert-bubble');
        bubble.style.padding = '14px 18px';
        bubble.innerHTML = `
            <div style="display:flex;align-items:center;gap:5px;height:18px;">
                <span class="typing-dot"></span>
                <span class="typing-dot" style="animation-delay:.2s"></span>
                <span class="typing-dot" style="animation-delay:.4s"></span>
            </div>`;

        row.appendChild(av);
        row.appendChild(bubble);
        return row;
    }

    // ── File attachment ──────────────────────────────────────────────
    btnAttach.addEventListener('click', function () { fileInput.click(); });

    fileInput.addEventListener('change', function () {
        if (!fileInput.files || !fileInput.files.length) return;
        for (let i = 0; i < fileInput.files.length; i++) {
            const f    = fileInput.files[i];
            const size = (f.size / (1024 * 1024)).toFixed(1);
            const ext  = f.name.split('.').pop().toUpperCase();
            const meta = size + ' MB · ' + ext + ' ' + (f.type.startsWith('image/') ? 'Image' : 'File');
            const time = getCurrentTime();

            roomHistory[currentExpert].push({ type: 'attachment', fileName: f.name, fileMeta: meta, time: time });
            appendAttachmentBubble(f.name, meta, time, true);
            scrollToBottom();
            simulateExpertReply(currentExpert);
        }
        fileInput.value = '';
    });

    // ── Emoji picker ─────────────────────────────────────────────────
    const emojiList = ['😊','🌱','🌿','🍅','🌻','💧','🌾','🪴','🐛','🦋','🌞','🍃'];
    let emojiPicker = null;

    btnEmoji.addEventListener('click', function (e) {
        e.stopPropagation();
        if (emojiPicker) { emojiPicker.remove(); emojiPicker = null; return; }

        emojiPicker = document.createElement('div');
        emojiPicker.classList.add('emoji-picker');

        emojiList.forEach(function (em) {
            const btn = document.createElement('button');
            btn.textContent = em;
            btn.addEventListener('click', function () {
                messageInput.value += em;
                messageInput.focus();
                emojiPicker.remove();
                emojiPicker = null;
            });
            emojiPicker.appendChild(btn);
        });

        const inputBar = document.querySelector('.input-bar');
        inputBar.style.position = 'relative';
        inputBar.appendChild(emojiPicker);
    });

    document.addEventListener('click', function () {
        if (emojiPicker) { emojiPicker.remove(); emojiPicker = null; }
    });

    // ── Send events ──────────────────────────────────────────────────
    btnSend.addEventListener('click', sendMessage);
    messageInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    // ── Helpers ──────────────────────────────────────────────────────
    function scrollToBottom() {
        setTimeout(function () { messagesArea.scrollTop = messagesArea.scrollHeight; }, 50);
    }

    function getCurrentTime() {
        const now = new Date();
        let h = now.getHours();
        const m = now.getMinutes().toString().padStart(2, '0');
        const ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        return h + ':' + m + ' ' + ampm;
    }

    function escapeHtml(str) {
        return str.replace(/[&<>"']/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
        });
    }

    function getStatusClass(status) {
        return { online: 'available', away: 'away-status', offline: 'offline-status' }[status] || 'offline-status';
    }

    function getStatusLabel(expert) {
        return { online: 'Available now', away: 'Away · 2 hours', offline: 'Offline' }[expert.status] || 'Offline';
    }

    // Init visible class
    messagesArea.classList.add('visible');
});