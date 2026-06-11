/* =============================================
   script-roomChatExpert.js
   Expert Consultation Chat — Botanist Side
   Fully dynamic AJAX polling version
============================================= */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const consultation = window.CONSULTATION;
    if (!consultation) {
        console.error("Consultation configuration not found!");
        return;
    }

    // --- DOM Elements ---
    const messagesList      = document.getElementById('messagesList');
    const messagesContainer = document.getElementById('messagesContainer');
    const messageInput      = document.getElementById('messageInput');
    const sendBtn           = document.getElementById('sendBtn');
    const inputArea         = document.getElementById('inputArea');
    const endedBanner       = document.getElementById('endedBanner');
    const endChatBtn        = document.getElementById('endChatBtn');
    const mediaPreviewBar   = document.getElementById('mediaPreviewBar');
    const mediaThumbWrap    = document.getElementById('mediaThumbWrap');
    const mediaFilename     = document.getElementById('mediaFilename');
    const mediaFilesize     = document.getElementById('mediaFilesize');
    const attachMenu        = document.getElementById('attachMenu');
    const fileInputPhoto    = document.getElementById('fileInputPhoto');
    const fileInputVideo    = document.getElementById('fileInputVideo');

    let renderedMessageIds = new Set();
    let isSending = false;
    let pendingFile = null; // { file, objectUrl, type: 'image'|'video' }

    // --- Date Divider ---
    const dateText = document.getElementById('dateDividerText');
    if (dateText) {
        const now = new Date();
        const days = ['SUNDAY','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY'];
        const months = ['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];
        dateText.textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}`;
    }

    // --- Polling Initialization ---
    fetchMessages();
    const pollInterval = setInterval(fetchMessages, 2000);

    function fetchMessages() {
        fetch(consultation.getMessagesUrl)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.status === 'selesai') {
                        applyEndedState();
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
        const isMe = msg.from === 'ahli'; // expert is 'ahli'
        const row = document.createElement('div');
        row.className = isMe ? 'message-row expert-row' : 'message-row user-row';

        if (!isMe) {
            // Client message has avatar shell
            const shell = document.createElement('div');
            shell.className = 'msg-avatar-shell';
            const headerNameEl = document.getElementById('headerName');
            const initials = headerNameEl ? headerNameEl.textContent.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase() : 'US';
            shell.dataset.initials = initials;

            const headerImg = document.getElementById('headerAvatarImg');
            if (headerImg && headerImg.style.display !== 'none') {
                const avatarImg = document.createElement('img');
                avatarImg.src = headerImg.src;
                avatarImg.alt = 'User';
                avatarImg.className = 'avatar-img';
                avatarImg.onerror = () => { avatarImg.style.display = 'none'; };
                shell.appendChild(avatarImg);
            }

            row.appendChild(shell);
        }

        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        // Check content type
        if (msg.type === 'image') {
            const msgImg = document.createElement('img');
            msgImg.src = msg.src;
            msgImg.className = 'msg-image';
            msgImg.alt = 'Image';
            msgImg.onclick = () => openLightbox(msg.src, 'image');
            bubble.appendChild(msgImg);
        } else if (msg.type === 'video') {
            const video = document.createElement('video');
            video.src = msg.src;
            video.className = 'msg-image'; // reuse style or style manually
            video.controls = true;
            video.style.maxWidth = '240px';
            video.style.borderRadius = '14px';
            bubble.appendChild(video);
        }

        if (msg.text) {
            const p = document.createElement('p');
            p.textContent = msg.text;
            p.style.margin = '0';
            if (msg.type !== 'text') {
                p.style.marginTop = '8px';
            }
            bubble.appendChild(p);
        }

        const timeEl = document.createElement('span');
        timeEl.className = 'bubble-time';
        timeEl.textContent = msg.time;
        bubble.appendChild(timeEl);

        row.appendChild(bubble);
        messagesList.appendChild(row);
    }

    function applyEndedState() {
        if (inputArea) inputArea.classList.add('disabled');
        if (endedBanner) endedBanner.style.display = 'flex';
        if (endChatBtn) endChatBtn.classList.add('ended');
    }

    // --- Message Sending ---
    window.sendMessage = function() {
        const text = messageInput.value.trim();
        const hasMedia = !!pendingFile;

        if (!text && !hasMedia) return;
        if (isSending) return;

        isSending = true;
        sendBtn.disabled = true;
        sendBtn.style.opacity = '.5';

        const formData = new FormData();
        formData.append('_token', consultation.csrfToken);
        if (text) formData.append('text', text);
        if (hasMedia) formData.append('file', pendingFile.file);

        fetch(consultation.sendMessageUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                removeMedia();
                fetchMessages();
            } else {
                alert(data.message || 'Failed to send message.');
            }
        })
        .catch(err => console.error("Error sending message:", err))
        .finally(() => {
            isSending = false;
            sendBtn.disabled = false;
            sendBtn.style.opacity = '1';
        });
    };

    // --- Attach Dropdown & Media Actions ---
    let attachMenuOpen = false;
    window.toggleAttachMenu = function() {
        attachMenuOpen = !attachMenuOpen;
        if (attachMenu) attachMenu.classList.toggle('open', attachMenuOpen);
    };

    window.closeAttachMenu = function() {
        attachMenuOpen = false;
        if (attachMenu) attachMenu.classList.remove('open');
    };

    document.addEventListener('click', (e) => {
        const wrap = document.getElementById('attachWrap');
        if (wrap && !wrap.contains(e.target)) closeAttachMenu();
    });

    window.pickPhoto = function() {
        closeAttachMenu();
        if (fileInputPhoto) fileInputPhoto.click();
    };

    window.pickVideo = function() {
        closeAttachMenu();
        if (fileInputVideo) fileInputVideo.click();
    };

    window.handleFileSelect = function(input) {
        const file = input.files[0];
        if (!file) return;

        input.value = '';

        const isImage = file.type.startsWith('image/');
        const isVideo = file.type.startsWith('video/');
        if (!isImage && !isVideo) return;

        if (pendingFile) URL.revokeObjectURL(pendingFile.objectUrl);

        const objectUrl = URL.createObjectURL(file);
        pendingFile = { file, objectUrl, type: isImage ? 'image' : 'video' };

        showMediaPreview(file, objectUrl, isImage ? 'image' : 'video');
    };

    function showMediaPreview(file, objectUrl, type) {
        if (mediaThumbWrap) {
            mediaThumbWrap.innerHTML = '';
            if (type === 'image') {
                const img = document.createElement('img');
                img.src = objectUrl;
                img.alt = file.name;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                mediaThumbWrap.appendChild(img);
            } else {
                const vid = document.createElement('video');
                vid.src = objectUrl;
                vid.muted = true;
                vid.style.width = '100%';
                vid.style.height = '100%';
                vid.style.objectFit = 'cover';
                vid.style.borderRadius = '8px';
                mediaThumbWrap.appendChild(vid);
            }
        }

        if (mediaFilename) mediaFilename.textContent = file.name.length > 28 ? file.name.slice(0, 26) + '…' : file.name;
        if (mediaFilesize) mediaFilesize.textContent = formatBytes(file.size);
        if (mediaPreviewBar) mediaPreviewBar.style.display = 'block';

        if (messageInput) messageInput.focus();
    }

    window.removeMedia = function() {
        if (pendingFile) {
            URL.revokeObjectURL(pendingFile.objectUrl);
            pendingFile = null;
        }
        if (mediaPreviewBar) mediaPreviewBar.style.display = 'none';
        if (mediaThumbWrap) mediaThumbWrap.innerHTML = '';
    };

    function formatBytes(bytes) {
        if (bytes < 1024)       return bytes + ' B';
        if (bytes < 1024*1024)  return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / (1024*1024)).toFixed(1) + ' MB';
    }

    // --- End Chat Modal Controls ---
    window.openEndChatModal = function() {
        const modal = document.getElementById('endChatModal');
        if (modal) modal.classList.add('active');
    };

    window.closeEndChatModal = function() {
        const modal = document.getElementById('endChatModal');
        if (modal) modal.classList.remove('active');
    };

    window.confirmEndChat = function() {
        fetch(consultation.endChatUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': consultation.csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                closeEndChatModal();
                fetchMessages();
            } else {
                alert('Failed to end chat.');
            }
        })
        .catch(err => console.error("Error ending chat:", err));
    };

    // --- Lightbox ---
    window.openLightbox = function(src, type) {
        const overlay = document.createElement('div');
        overlay.className = 'lightbox-overlay';

        let media;
        if (type === 'image') {
            media = document.createElement('img');
            media.src = src;
            media.alt = 'Full view';
        } else {
            media = document.createElement('video');
            media.src = src;
            media.controls = true;
            media.autoplay = true;
        }

        const closeBtn = document.createElement('button');
        closeBtn.className = 'lightbox-close';
        closeBtn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>`;

        const closeFn = () => { overlay.remove(); };
        closeBtn.addEventListener('click', closeFn);
        overlay.addEventListener('click', (e) => { if (e.target === overlay) closeFn(); });

        overlay.appendChild(media);
        overlay.appendChild(closeBtn);
        document.body.appendChild(overlay);
    };

    // --- Event Listeners ---
    if (messageInput) {
        messageInput.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    // Emoji Picker dummy trigger
    window.openEmoji = function() {
        const emojiList = ['😊','🌱','🌿','🍅','🌻','💧','🌾','🪴','🐛','🦋','🌞','🍃'];
        let picker = document.getElementById('emojiPickerEl');
        if (picker) {
            picker.remove();
            return;
        }

        picker = document.createElement('div');
        picker.id = 'emojiPickerEl';
        picker.style.position = 'absolute';
        picker.style.bottom = '60px';
        picker.style.left = '40px';
        picker.style.background = '#fff';
        picker.style.border = '1px solid #ddd';
        picker.style.borderRadius = '8px';
        picker.style.padding = '8px';
        picker.style.display = 'grid';
        picker.style.gridTemplateColumns = 'repeat(4, 1fr)';
        picker.style.gap = '5px';
        picker.style.zIndex = '100';

        emojiList.forEach(emoji => {
            const btn = document.createElement('button');
            btn.textContent = emoji;
            btn.style.border = 'none';
            btn.style.background = 'none';
            btn.style.fontSize = '20px';
            btn.style.cursor = 'pointer';
            btn.addEventListener('click', () => {
                messageInput.value += emoji;
                messageInput.focus();
                picker.remove();
            });
            picker.appendChild(btn);
        });

        document.getElementById('inputArea').style.position = 'relative';
        document.getElementById('inputArea').appendChild(picker);
    };

    document.addEventListener('click', (e) => {
        const picker = document.getElementById('emojiPickerEl');
        const emojiBtn = document.getElementById('emojiBtn');
        if (picker && !picker.contains(e.target) && e.target !== emojiBtn) {
            picker.remove();
        }
    });

    function scrollToBottom() {
        setTimeout(function () { if (messagesContainer) messagesContainer.scrollTop = messagesContainer.scrollHeight; }, 50);
    }
});