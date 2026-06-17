/* =============================================
   script-roomChatExpert.js
   Expert Consultation Chat — Real DB Integration
============================================= */

'use strict';

// =============================================
// AVATAR GRADIENT HELPER
// =============================================

const avatarGradients = [
    'linear-gradient(135deg, #99ff99, #76ead0)',
    'linear-gradient(135deg, #76ead0, #76d7ea)',
    'linear-gradient(135deg, #d0ff99, #99ff99)',
    'linear-gradient(135deg, #ffff9f, #d0ff99)',
    'linear-gradient(135deg, #76d7ea, #99ff99)',
];

function avatarGradient(idx) {
    return avatarGradients[idx % avatarGradients.length];
}

// =============================================
// DATE HELPER
// =============================================

function getTodayLabel() {
    const now = new Date();
    const days   = ['SUNDAY','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY'];
    const months = ['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];
    return `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}`;
}

// =============================================
// STATE
// =============================================

const consultation = window.ACTIVE_CONSULTATION;
const initialMessages = window.INITIAL_MESSAGES || [];
const csrfToken = window.CSRF_TOKEN || '';
let lastMessageId = 0;
let pollingInterval = null;
let chatEnded = false;

// =============================================
// INIT
// =============================================

document.addEventListener('DOMContentLoaded', () => {
    if (!consultation) return;

    const dateText = document.getElementById('dateDividerText');
    if (dateText) dateText.textContent = getTodayLabel();

    // Render initial messages from DB
    renderInitialMessages();

    // Bind input
    bindInputEnter();

    // Start polling for new messages every 3 seconds
    pollingInterval = setInterval(pollNewMessages, 3000);

    // Search in sidebar
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const keyword = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.chat-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(keyword) ? 'flex' : 'none';
            });
        });
    }
});

// =============================================
// RENDER INITIAL MESSAGES FROM DB
// =============================================

function renderInitialMessages() {
    const list = document.getElementById('messagesList');
    if (!list) return;
    list.innerHTML = '';

    initialMessages.forEach(msg => {
        list.appendChild(createMessageEl(msg));
        if (msg.id > lastMessageId) lastMessageId = msg.id;
    });

    scrollToBottom();
}

// =============================================
// CREATE MESSAGE ELEMENT
// =============================================

function createMessageEl(msg) {
    const row = document.createElement('div');

    if (msg.pengirim === 'user') {
        // Client/user message — left side
        row.className = 'message-row user-row';

        const shell = document.createElement('div');
        shell.className = 'msg-avatar-shell';
        shell.dataset.initials = consultation.user_initials;
        shell.style.background = avatarGradient(0);

        if (consultation.user_avatar) {
            const avatarImg = document.createElement('img');
            avatarImg.src = consultation.user_avatar;
            avatarImg.alt = consultation.user_name;
            avatarImg.className = 'avatar-img';
            avatarImg.onerror = () => { avatarImg.style.display = 'none'; };
            shell.appendChild(avatarImg);
        }

        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        if (msg.gambar) {
            const msgImg = document.createElement('img');
            msgImg.src = msg.gambar;
            msgImg.className = 'msg-image';
            msgImg.alt = 'Image';
            bubble.appendChild(msgImg);
        }

        if (msg.isi_pesan) {
            bubble.textContent = msg.isi_pesan;
        }

        const timeEl = document.createElement('span');
        timeEl.className = 'bubble-time';
        timeEl.textContent = msg.waktu_kirim;
        bubble.appendChild(timeEl);

        row.appendChild(shell);
        row.appendChild(bubble);
    } else {
        // Expert message — right side
        row.className = 'message-row expert-row';

        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        if (msg.gambar) {
            const msgImg = document.createElement('img');
            msgImg.src = msg.gambar;
            msgImg.className = 'msg-image';
            msgImg.alt = 'Image';
            bubble.appendChild(msgImg);
        }

        if (msg.isi_pesan) {
            bubble.textContent = msg.isi_pesan;
        }

        const timeEl = document.createElement('span');
        timeEl.className = 'bubble-time';
        timeEl.textContent = msg.waktu_kirim;
        bubble.appendChild(timeEl);

        row.appendChild(bubble);
    }

    return row;
}

// =============================================
// SEND MESSAGE (real — POST to /pesan)
// =============================================

function sendMessage() {
    if (chatEnded || !consultation) return;

    const input = document.getElementById('messageInput');
    const text = input.value.trim();
    const hasMedia = !!pendingFile;

    if (!text && !hasMedia) return;

    const formData = new FormData();
    formData.append('konsultasi_id', consultation.id);
    formData.append('_token', csrfToken);

    if (text) {
        formData.append('isi_pesan', text);
    }

    if (hasMedia && pendingFile.file) {
        formData.append('gambar', pendingFile.file);
    }

    // Optimistic UI — show bubble immediately
    const now = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    
    const list = document.getElementById('messagesList');

    if (hasMedia && pendingFile.objectUrl) {
        const previewMsg = {
            pengirim: 'ahli',
            isi_pesan: null,
            gambar: pendingFile.objectUrl,
            waktu_kirim: timeStr,
        };
        list.appendChild(createMessageEl(previewMsg));
        removeMedia();
    }

    if (text) {
        const textMsg = {
            pengirim: 'ahli',
            isi_pesan: text,
            gambar: null,
            waktu_kirim: timeStr,
        };
        list.appendChild(createMessageEl(textMsg));
        input.value = '';
    }

    scrollToBottom();
    setInputDisabled(true);

    fetch('/pesan', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success && data.data.id > lastMessageId) {
            lastMessageId = data.data.id;
        }
        setInputDisabled(false);
        input.focus();
    })
    .catch(err => {
        console.error('Failed to send message:', err);
        setInputDisabled(false);
    });
}

// =============================================
// POLL FOR NEW MESSAGES
// =============================================

function pollNewMessages() {
    if (!consultation || chatEnded) return;

    fetch(`/pesan/${consultation.id}?after_id=${lastMessageId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.data && data.data.length > 0) {
            const list = document.getElementById('messagesList');
            data.data.forEach(msg => {
                // Only add messages we haven't rendered yet
                // Skip our own messages (we already showed them optimistically)
                if (msg.id > lastMessageId) {
                    if (msg.pengirim === 'user') {
                        list.appendChild(createMessageEl(msg));
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

// =============================================
// END CHAT
// =============================================

function openEndChatModal() {
    if (chatEnded) return;
    const modal = document.getElementById('endChatModal');
    if (modal) modal.classList.add('active');
}

function closeEndChatModal() {
    const modal = document.getElementById('endChatModal');
    if (modal) modal.classList.remove('active');
}

function confirmEndChat() {
    closeEndChatModal();

    fetch(`/konsultasi/${consultation.id}/end`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        chatEnded = true;
        clearInterval(pollingInterval);

        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        addSystemMessage(`Consultation ended at ${timeStr}`);

        const inputArea = document.getElementById('inputArea');
        const endBtn = document.getElementById('endChatBtn');
        const banner = document.getElementById('endedBanner');
        if (inputArea) inputArea.classList.add('disabled');
        if (endBtn) endBtn.classList.add('ended');
        if (banner) banner.style.display = 'flex';
    })
    .catch(err => {
        console.error('Failed to end chat:', err);
    });
}

// =============================================
// SYSTEM MESSAGE
// =============================================

function addSystemMessage(text) {
    const list = document.getElementById('messagesList');
    const el = document.createElement('div');
    el.className = 'date-divider';
    el.style.marginTop = '16px';
    el.innerHTML = `<span style="color:#e11d48;background:#fff5f5;padding:4px 16px;border-radius:20px;">${text}</span>`;
    list.appendChild(el);
    scrollToBottom();
}

// =============================================
// BIND ENTER KEY
// =============================================

function bindInputEnter() {
    const input = document.getElementById('messageInput');
    if (!input) return;
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
}

// =============================================
// UTILITIES
// =============================================

function scrollToBottom() {
    const container = document.getElementById('messagesContainer');
    if (container) container.scrollTop = container.scrollHeight;
}

function setInputDisabled(state) {
    const input = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    if (input) { input.disabled = state; input.style.opacity = state ? '0.5' : '1'; }
    if (sendBtn) { sendBtn.disabled = state; sendBtn.style.opacity = state ? '0.5' : '1'; }
}

// =============================================
// ATTACH MENU
// =============================================

let attachMenuOpen = false;

function toggleAttachMenu() {
    attachMenuOpen = !attachMenuOpen;
    const menu = document.getElementById('attachMenu');
    if (menu) menu.classList.toggle('open', attachMenuOpen);
}

function closeAttachMenu() {
    attachMenuOpen = false;
    const menu = document.getElementById('attachMenu');
    if (menu) menu.classList.remove('open');
}

document.addEventListener('click', (e) => {
    const wrap = document.getElementById('attachWrap');
    if (wrap && !wrap.contains(e.target)) closeAttachMenu();
});

function pickPhoto() {
    closeAttachMenu();
    document.getElementById('fileInputPhoto').click();
}

function pickVideo() {
    closeAttachMenu();
    document.getElementById('fileInputVideo').click();
}

// =============================================
// FILE SELECT & PREVIEW
// =============================================

let pendingFile = null;

function handleFileSelect(input) {
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
}

function showMediaPreview(file, objectUrl, type) {
    const bar = document.getElementById('mediaPreviewBar');
    const thumbWrap = document.getElementById('mediaThumbWrap');
    const filename = document.getElementById('mediaFilename');
    const filesize = document.getElementById('mediaFilesize');

    thumbWrap.innerHTML = '';
    if (type === 'image') {
        const img = document.createElement('img');
        img.src = objectUrl;
        img.alt = file.name;
        thumbWrap.appendChild(img);
    } else {
        const vid = document.createElement('video');
        vid.src = objectUrl;
        vid.muted = true;
        thumbWrap.appendChild(vid);
    }

    filename.textContent = file.name.length > 28 ? file.name.slice(0, 26) + '…' : file.name;
    filesize.textContent = formatBytes(file.size);

    bar.style.display = 'block';
    document.getElementById('messageInput').focus();
}

function removeMedia() {
    if (pendingFile) {
        URL.revokeObjectURL(pendingFile.objectUrl);
        pendingFile = null;
    }
    const bar = document.getElementById('mediaPreviewBar');
    const thumbWrap = document.getElementById('mediaThumbWrap');
    if (bar) bar.style.display = 'none';
    if (thumbWrap) thumbWrap.innerHTML = '';
}

function formatBytes(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
}

function openEmoji() { console.log('Emoji — extend with emoji picker'); }
function openMoreOptions() { console.log('More options — extend with dropdown'); }