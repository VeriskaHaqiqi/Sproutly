// public/js/script-roomChatUser.js

document.addEventListener('DOMContentLoaded', function () {
    const consultation = window.CONSULTATION;
    if (!consultation) {
        console.error("Consultation configuration not found!");
        return;
    }

    const messagesArea  = document.getElementById('messagesArea');
    const messageInput  = document.getElementById('messageInput');
    const btnSend       = document.getElementById('btnSend');
    const btnAttach     = document.getElementById('btnAttach');
    const btnEmoji      = document.getElementById('btnEmoji');
    const fileInput     = document.getElementById('fileInput');

    let renderedMessageIds = new Set();
    let isSending = false;

    // Fetch messages initially and periodically
    fetchMessages();
    const pollInterval = setInterval(fetchMessages, 2000);

    function fetchMessages() {
        fetch(consultation.getMessagesUrl)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.status === 'selesai') {
                        // Redirect client/user to the review/ended screen
                        clearInterval(pollInterval);
                        window.location.href = `/roomChatUser/ended?id=${consultation.id}`;
                        return;
                    }
                    
                    let hasNew = false;
                    data.messages.forEach(msg => {
                        if (!renderedMessageIds.has(msg.id)) {
                            renderedMessageIds.add(msg.id);
                            appendMessageBubble(msg);
                            hasNew = true;
                        }
                    });

                    if (hasNew) {
                        scrollToBottom();
                    }
                }
            })
            .catch(err => console.error("Error fetching messages:", err));
    }

    function appendMessageBubble(msg) {
        const isUser = msg.from === 'user';
        const row = document.createElement('div');
        row.className = isUser ? 'message-row user-row' : 'message-row expert-row';

        if (!isUser) {
            // Expert avatar/initials
            const av = document.createElement('div');
            av.className = 'msg-avatar-initials';
            const headerInit = document.getElementById('headerAvatar');
            av.textContent = headerInit && headerInit.style.display !== 'none' ? headerInit.textContent : 'EX';
            av.style.background = 'linear-gradient(135deg, #76ead0, #76d7ea)';
            
            // If header has a visible image avatar, clone it or use it
            const headerImg = document.querySelector('.header-expert img');
            if (headerImg && headerImg.style.display !== 'none') {
                const img = document.createElement('img');
                img.src = headerImg.src;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.borderRadius = '50%';
                img.style.objectFit = 'cover';
                av.innerHTML = '';
                av.appendChild(img);
            }

            row.appendChild(av);
        }

        const bubble = document.createElement('div');
        bubble.className = isUser ? 'bubble user-bubble' : 'bubble expert-bubble';

        // Message types: image, video, text
        if (msg.type === 'image') {
            const img = document.createElement('img');
            img.src = msg.src;
            img.style.maxWidth = '100%';
            img.style.borderRadius = '8px';
            img.style.cursor = 'pointer';
            img.onclick = () => window.open(msg.src, '_blank');
            bubble.appendChild(img);
        } else if (msg.type === 'video') {
            const video = document.createElement('video');
            video.src = msg.src;
            video.controls = true;
            video.style.maxWidth = '100%';
            video.style.borderRadius = '8px';
            bubble.appendChild(video);
        }

        if (msg.text) {
            const p = document.createElement('p');
            p.textContent = msg.text;
            p.style.margin = '0';
            p.style.marginTop = msg.type !== 'text' ? '8px' : '0';
            bubble.appendChild(p);
        }

        const t = document.createElement('span');
        t.className = 'msg-time';
        t.textContent = msg.time;
        bubble.appendChild(t);

        row.appendChild(bubble);
        messagesArea.appendChild(row);
    }

    function sendMessage() {
        const text = messageInput.value.trim();
        if (!text || isSending) return;

        isSending = true;
        btnSend.disabled = true;
        btnSend.style.opacity = '.5';

        const formData = new FormData();
        formData.append('text', text);
        formData.append('_token', consultation.csrfToken);

        fetch(consultation.sendMessageUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                fetchMessages();
            } else {
                alert(data.message || 'Failed to send message.');
            }
        })
        .catch(err => console.error("Error sending message:", err))
        .finally(() => {
            isSending = false;
            btnSend.disabled = false;
            btnSend.style.opacity = '1';
        });
    }

    // Attach trigger
    btnAttach.addEventListener('click', function () { fileInput.click(); });

    // File selection handling
    fileInput.addEventListener('change', function () {
        if (!fileInput.files || !fileInput.files.length) return;

        const file = fileInput.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', consultation.csrfToken);

        fetch(consultation.sendMessageUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                fetchMessages();
            } else {
                alert(data.message || 'Failed to upload attachment.');
            }
        })
        .catch(err => console.error("Error uploading file:", err))
        .finally(() => {
            fileInput.value = '';
        });
    });

    // Emoji Picker Setup
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

    btnSend.addEventListener('click', sendMessage);
    messageInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    function scrollToBottom() {
        setTimeout(function () { messagesArea.scrollTop = messagesArea.scrollHeight; }, 50);
    }
});