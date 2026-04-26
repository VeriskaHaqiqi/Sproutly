/* =============================================
   script-roomChatExpert.js
   Expert Consultation Chat — Botanist Side
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
// ROOM DATA
// =============================================

const rooms = {
    sarah: {
        name: 'Sarah Johnson',
        initials: 'SJ',
        colorIdx: 0,
        topic: 'Tomato Plant Issue',
        tag: 'TOMATO EXPERT',
        status: 'online',
        statusText: 'Online • Tomato Plant Issue',
        avatar: 'image/avatar-sarah.png',
        ended: false,
        messages: [
            { from: 'user',   type: 'text',  text: 'Hi expert, my tomato plants have these weird brown spots on the lower leaves. What should I do?', time: '10:12 AM' },
            { from: 'user',   type: 'image', src: 'image/tomato-plant.png', time: '10:13 AM' },
            { from: 'expert', type: 'text',  text: 'Hello Sarah! Looking at the image, it looks like early blight. This is common in tomatoes. How often are you watering them?', time: '10:15 AM' },
            { from: 'user',   type: 'text',  text: 'I water them once every morning. Should I reduce it?', time: '10:16 AM' },
            { from: 'expert', type: 'text',  text: "It's better to water the soil directly, avoiding the leaves. Try switching to deep watering every 2-3 days instead. I'll send you a guide on blight management.", time: '10:18 AM' },
        ],
    },
    marcus: {
        name: 'Marcus Chen',
        initials: 'MC',
        colorIdx: 1,
        topic: 'Hydroponic pH Levels',
        tag: 'HYDRO EXPERT',
        status: 'away',
        statusText: 'Away • Hydroponic pH Levels',
        avatar: 'image/avatar-marcus.png',
        ended: false,
        messages: [
            { from: 'user',   type: 'text', text: 'Hi, my hydroponic system keeps fluctuating in pH between 5.2 and 7.1. Is this normal?', time: '9:00 AM' },
            { from: 'expert', type: 'text', text: 'Hi Marcus! That range is too wide — ideal pH for most hydro plants is 5.5 to 6.5. Fluctuation beyond that can lock out nutrients.', time: '9:05 AM' },
            { from: 'user',   type: 'text', text: 'What could be causing such big swings?', time: '9:08 AM' },
        ],
    },
    elena: {
        name: 'Elena Rodriguez',
        initials: 'ER',
        colorIdx: 2,
        topic: 'Vineyard Pest Control',
        tag: 'PEST EXPERT',
        status: 'offline',
        statusText: 'Offline • Vineyard Pest Control',
        avatar: 'image/avatar-elena.png',
        ended: false,
        messages: [
            { from: 'user',   type: 'text', text: 'We have been noticing small white bugs on our grape leaves. Could these be mealybugs?', time: 'Yesterday 2:00 PM' },
            { from: 'expert', type: 'text', text: 'Hi Elena! Yes, those are very likely mealybugs. A neem oil spray solution works well for vineyards.', time: 'Yesterday 2:15 PM' },
            { from: 'user',   type: 'text', text: 'How often should I spray?', time: 'Yesterday 3:00 PM' },
        ],
    },
    james: {
        name: 'Dr. James',
        initials: 'DJ',
        colorIdx: 3,
        topic: 'Orchid Root Rot',
        tag: 'ORCHID EXPERT',
        status: 'online',
        statusText: 'Online • Orchid Root Rot',
        avatar: 'image/avatar-james.png',
        ended: false,
        messages: [
            { from: 'user',   type: 'text', text: 'Hello, my Phalaenopsis orchid roots are turning black and mushy. I think it might be root rot.', time: '7:30 AM' },
            { from: 'expert', type: 'text', text: 'Hello Dr. James! Root rot in orchids is usually caused by overwatering or poor drainage.', time: '7:35 AM' },
            { from: 'user',   type: 'text', text: 'I water it twice a week. The pot does have drainage holes.', time: '7:38 AM' },
            { from: 'expert', type: 'text', text: "Twice a week might be too much — orchids usually only need watering when the roots appear silvery-white. Remove affected roots and repot in fresh bark medium.", time: '7:42 AM' },
        ],
    },
    emma: {
        name: 'Dr. Emma',
        initials: 'DE',
        colorIdx: 4,
        topic: 'Lavender Propagation',
        tag: 'HERB EXPERT',
        status: 'online',
        statusText: 'Online • Lavender Propagation',
        avatar: 'image/avatar-emma.png',
        ended: false,
        messages: [
            { from: 'user',   type: 'text', text: 'Hi! I want to propagate my lavender through cuttings but they keep drying out before they root.', time: '5:00 AM' },
            { from: 'expert', type: 'text', text: 'Hello Dr. Emma! Lavender cuttings need high humidity to root well. Try covering them with a clear plastic bag or humidity dome.', time: '5:10 AM' },
            { from: 'user',   type: 'text', text: 'What medium do you recommend? I have been using regular potting mix.', time: '5:14 AM' },
            { from: 'expert', type: 'text', text: 'Switch to a 50/50 mix of perlite and coarse sand. Regular potting mix retains too much moisture and can rot the cutting base before rooting.', time: '5:18 AM' },
        ],
    },
};

// =============================================
// DUMMY USER REPLIES
// =============================================

const dummyReplies = {
    sarah:  ['Thank you so much! I will try that right away.', 'Should I remove the affected leaves first?', 'Got it, deep watering every 2-3 days. Noted!', 'Should I apply any fungicide?', 'The spots seem to be spreading. Is that normal?'],
    marcus: ['Ah I see, so my range is too wide. What should I adjust first?', 'I will check my reservoir and nutrient solution.', 'Should I do a full water change or just top it up?', 'Thank you, I will try buffering it with pH down slowly.'],
    elena:  ['Neem oil — okay I will get that this weekend.', 'How diluted should the neem oil solution be?', 'Should I spray in the morning or evening?', 'I noticed some on the stems too, is that bad?'],
    james:  ['I will trim the rotted roots today and repot.', 'Should I let the roots dry a bit before repotting?', 'What bark medium do you recommend for Phalaenopsis?', 'Should I apply fungicide to the cut roots?'],
    emma:   ['Perlite and coarse sand mix, got it!', 'How long does lavender take to root from cuttings?', 'Should I use rooting hormone powder?', 'The humidity dome idea sounds great, I will set that up.'],
};

const replyIndex = { sarah: 0, marcus: 0, elena: 0, james: 0, emma: 0 };

// =============================================
// STATE
// =============================================

let currentRoom = 'sarah';

// =============================================
// INIT
// =============================================

document.addEventListener('DOMContentLoaded', () => {
    // Set today's date on date divider
    const dateText = document.getElementById('dateDividerText');
    if (dateText) dateText.textContent = getTodayLabel();

    renderMessages(currentRoom);
    updateHeader(currentRoom);
    bindInputEnter();
});

// =============================================
// ROOM SWITCHING
// =============================================

function switchRoom(roomKey) {
    if (!rooms[roomKey]) return;

    document.querySelectorAll('.chat-item').forEach(el => el.classList.remove('active'));
    const activeEl = document.querySelector(`.chat-item[data-room="${roomKey}"]`);
    if (activeEl) activeEl.classList.add('active');

    currentRoom = roomKey;
    renderMessages(roomKey);
    updateHeader(roomKey);
    clearInput();
    applyEndedState(roomKey);
}

// =============================================
// RENDER MESSAGES
// =============================================

function renderMessages(roomKey) {
    const room = rooms[roomKey];
    const list = document.getElementById('messagesList');
    list.innerHTML = '';
    room.messages.forEach(msg => list.appendChild(createMessageEl(msg, room)));
    scrollToBottom();
}

// =============================================
// CREATE MESSAGE ELEMENT
// =============================================

function createMessageEl(msg, room) {
    const row = document.createElement('div');

    if (msg.from === 'user') {
        // Client/user message — left side, white bubble
        row.className = 'message-row user-row';

        const shell = document.createElement('div');
        shell.className        = 'msg-avatar-shell';
        shell.dataset.initials = room.initials;
        shell.style.background = avatarGradient(room.colorIdx);

        const avatarImg     = document.createElement('img');
        avatarImg.src       = room.avatar;
        avatarImg.alt       = room.name;
        avatarImg.className = 'avatar-img';
        avatarImg.onerror   = () => { avatarImg.style.display = 'none'; };
        shell.appendChild(avatarImg);

        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        if (msg.type === 'image') {
            const msgImg     = document.createElement('img');
            msgImg.src       = msg.src;
            msgImg.className = 'msg-image';
            msgImg.alt       = 'Image';
            msgImg.onerror   = () => { msgImg.style.display = 'none'; };
            msgImg.addEventListener('click', () => openLightbox(msg.src, 'image'));
            bubble.appendChild(msgImg);
        } else if (msg.type === 'video') {
            bubble.appendChild(buildVideoBubble(msg.src));
        } else {
            bubble.textContent = msg.text;
        }

        const timeEl       = document.createElement('span');
        timeEl.className   = 'bubble-time';
        timeEl.textContent = msg.time;
        bubble.appendChild(timeEl);

        row.appendChild(shell);
        row.appendChild(bubble);

    } else {
        // Expert message — right side, green bubble, NO avatar
        row.className = 'message-row expert-row';

        const bubble     = document.createElement('div');
        bubble.className = 'bubble';

        if (msg.type === 'image') {
            const msgImg     = document.createElement('img');
            msgImg.src       = msg.src;
            msgImg.className = 'msg-image';
            msgImg.alt       = 'Image';
            msgImg.onerror   = () => { msgImg.style.display = 'none'; };
            msgImg.addEventListener('click', () => openLightbox(msg.src, 'image'));
            bubble.appendChild(msgImg);
        } else if (msg.type === 'video') {
            bubble.appendChild(buildVideoBubble(msg.src));
        } else {
            bubble.textContent = msg.text;
        }

        const timeEl       = document.createElement('span');
        timeEl.className   = 'bubble-time';
        timeEl.textContent = msg.time;
        bubble.appendChild(timeEl);

        row.appendChild(bubble);
    }

    return row;
}

// =============================================
// VIDEO BUBBLE HELPER
// =============================================

function buildVideoBubble(src) {
    const wrap = document.createElement('div');
    wrap.className = 'msg-video-wrap';

    const vid      = document.createElement('video');
    vid.src        = src;
    vid.className  = 'msg-video';
    vid.muted      = true;
    vid.preload    = 'metadata';

    const overlay  = document.createElement('div');
    overlay.className = 'video-play-overlay';
    overlay.innerHTML = `
        <div class="video-play-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
            </svg>
        </div>`;

    wrap.appendChild(vid);
    wrap.appendChild(overlay);
    wrap.addEventListener('click', () => openLightbox(src, 'video'));
    return wrap;
}

// =============================================
// UPDATE HEADER
// =============================================

function updateHeader(roomKey) {
    const room = rooms[roomKey];

    const shell = document.getElementById('headerAvatarShell');
    if (shell) {
        shell.dataset.initials = room.initials;
        shell.style.background = avatarGradient(room.colorIdx);
    }

    const headerImg = document.getElementById('headerAvatarImg');
    if (headerImg) {
        headerImg.src         = room.avatar;
        headerImg.style.display = '';
        headerImg.onerror     = () => { headerImg.style.display = 'none'; };
    }

    const headerName = document.getElementById('headerName');
    const headerTag  = document.getElementById('headerTag');
    const headerSub  = document.getElementById('headerSub');
    const headerDot  = document.getElementById('headerStatusDot');

    if (headerName) headerName.textContent = room.name;
    if (headerTag)  headerTag.textContent  = room.tag;
    if (headerSub)  headerSub.innerHTML    = `<span class="dot-green">●</span> ${room.statusText}`;
    if (headerDot)  headerDot.className    = `status-dot ${room.status}`;
}

// =============================================
// APPLY ENDED STATE (per room)
// =============================================

function applyEndedState(roomKey) {
    const room      = rooms[roomKey];
    const inputArea = document.getElementById('inputArea');
    const endBtn    = document.getElementById('endChatBtn');
    const banner    = document.getElementById('endedBanner');

    if (room.ended) {
        if (inputArea) inputArea.classList.add('disabled');
        if (endBtn)    endBtn.classList.add('ended');
        if (banner)    banner.style.display = 'flex';
    } else {
        if (inputArea) inputArea.classList.remove('disabled');
        if (endBtn)    endBtn.classList.remove('ended');
        if (banner)    banner.style.display = 'none';
    }
}

// =============================================
// END CHAT MODAL
// =============================================

function openEndChatModal() {
    if (rooms[currentRoom].ended) return;
    const modal = document.getElementById('endChatModal');
    if (modal) modal.classList.add('active');
}

function closeEndChatModal() {
    const modal = document.getElementById('endChatModal');
    if (modal) modal.classList.remove('active');
}

function confirmEndChat() {
    closeEndChatModal();
    rooms[currentRoom].ended = true;

    // Add system message marking end of session
    const now     = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    addSystemMessage(`Consultation ended at ${timeStr}`);

    applyEndedState(currentRoom);

    // Update sidebar item status
    const chatItem = document.querySelector(`.chat-item[data-room="${currentRoom}"]`);
    if (chatItem) {
        const statusEl = chatItem.querySelector('.chat-status');
        if (statusEl) {
            statusEl.textContent = 'Ended';
            statusEl.className   = 'chat-status offline-label';
        }
    }
}

// =============================================
// SYSTEM MESSAGE (session end notice)
// =============================================

function addSystemMessage(text) {
    const list = document.getElementById('messagesList');
    const el   = document.createElement('div');
    el.className = 'date-divider';
    el.style.marginTop = '16px';
    el.innerHTML = `<span style="color:#e11d48;background:#fff5f5;padding:4px 16px;border-radius:20px;">${text}</span>`;
    list.appendChild(el);
    scrollToBottom();
}

// =============================================
// TYPING INDICATOR
// =============================================

function showTypingIndicator(room) {
    const list = document.getElementById('messagesList');

    const row = document.createElement('div');
    row.className = 'message-row user-row';
    row.id        = 'typingIndicator';

    const shell = document.createElement('div');
    shell.className        = 'msg-avatar-shell';
    shell.dataset.initials = room.initials;
    shell.style.background = avatarGradient(room.colorIdx);

    const avatarImg     = document.createElement('img');
    avatarImg.src       = room.avatar;
    avatarImg.alt       = room.name;
    avatarImg.className = 'avatar-img';
    avatarImg.onerror   = () => { avatarImg.style.display = 'none'; };
    shell.appendChild(avatarImg);

    const bubble = document.createElement('div');
    bubble.className = 'bubble typing-bubble';
    bubble.innerHTML = `
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>`;

    row.appendChild(shell);
    row.appendChild(bubble);
    list.appendChild(row);
    scrollToBottom();
}

function removeTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    if (indicator) indicator.remove();
}

// =============================================
// SEND MESSAGE
// =============================================

function sendMessage() {
    if (rooms[currentRoom].ended) return;

    const input = document.getElementById('messageInput');
    const text  = input.value.trim();
    if (!text) return;

    const now     = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

    const msg = { from: 'expert', type: 'text', text, time: timeStr };
    rooms[currentRoom].messages.push(msg);

    const list = document.getElementById('messagesList');
    list.appendChild(createMessageEl(msg, rooms[currentRoom]));

    input.value = '';
    scrollToBottom();
    setInputDisabled(true);

    const typingDelay = 800  + Math.random() * 600;
    const replyDelay  = typingDelay + 1400 + Math.random() * 800;

    const roomSnapshot = currentRoom;

    setTimeout(() => {
        if (currentRoom === roomSnapshot && !rooms[roomSnapshot].ended) {
            showTypingIndicator(rooms[roomSnapshot]);
        }
    }, typingDelay);

    setTimeout(() => {
        if (currentRoom === roomSnapshot) {
            removeTypingIndicator();
            if (!rooms[roomSnapshot].ended) {
                triggerDummyUserReply(roomSnapshot);
            }
        }
        if (!rooms[currentRoom].ended) setInputDisabled(false);
    }, replyDelay);
}

// =============================================
// DUMMY USER REPLY
// =============================================

function triggerDummyUserReply(roomKey) {
    const room    = rooms[roomKey];
    const replies = dummyReplies[roomKey] || ['Thank you!'];
    const idx     = replyIndex[roomKey] % replies.length;
    const text    = replies[idx];
    replyIndex[roomKey]++;

    const now     = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

    const msg = { from: 'user', type: 'text', text, time: timeStr };
    room.messages.push(msg);

    const list = document.getElementById('messagesList');
    list.appendChild(createMessageEl(msg, room));
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

function clearInput() {
    const input = document.getElementById('messageInput');
    if (input) input.value = '';
}

function setInputDisabled(state) {
    const input   = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    if (input)   { input.disabled   = state; input.style.opacity   = state ? '0.5' : '1'; }
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

// Close attach menu when clicking outside
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

let pendingFile = null; // { file, objectUrl, type: 'image'|'video' }

function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) return;

    // Reset input so same file can be re-selected
    input.value = '';

    const isImage = file.type.startsWith('image/');
    const isVideo = file.type.startsWith('video/');
    if (!isImage && !isVideo) return;

    // Revoke previous object URL if any
    if (pendingFile) URL.revokeObjectURL(pendingFile.objectUrl);

    const objectUrl = URL.createObjectURL(file);
    pendingFile = { file, objectUrl, type: isImage ? 'image' : 'video' };

    showMediaPreview(file, objectUrl, isImage ? 'image' : 'video');
}

function showMediaPreview(file, objectUrl, type) {
    const bar      = document.getElementById('mediaPreviewBar');
    const thumbWrap = document.getElementById('mediaThumbWrap');
    const filename = document.getElementById('mediaFilename');
    const filesize = document.getElementById('mediaFilesize');

    // Build thumbnail
    thumbWrap.innerHTML = '';
    if (type === 'image') {
        const img = document.createElement('img');
        img.src = objectUrl;
        img.alt = file.name;
        thumbWrap.appendChild(img);
    } else {
        const vid = document.createElement('video');
        vid.src  = objectUrl;
        vid.muted = true;
        thumbWrap.appendChild(vid);
    }

    filename.textContent = file.name.length > 28 ? file.name.slice(0, 26) + '…' : file.name;
    filesize.textContent = formatBytes(file.size);

    bar.style.display = 'block';
    // Focus input so user can still type a caption
    document.getElementById('messageInput').focus();
}

function removeMedia() {
    if (pendingFile) {
        URL.revokeObjectURL(pendingFile.objectUrl);
        pendingFile = null;
    }
    document.getElementById('mediaPreviewBar').style.display = 'none';
    document.getElementById('mediaThumbWrap').innerHTML = '';
}

function formatBytes(bytes) {
    if (bytes < 1024)       return bytes + ' B';
    if (bytes < 1024*1024)  return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024*1024)).toFixed(1) + ' MB';
}

// =============================================
// SEND MESSAGE (text + optional media)
// =============================================

function sendMessage() {
    if (rooms[currentRoom].ended) return;

    const input     = document.getElementById('messageInput');
    const text      = input.value.trim();
    const hasMedia  = !!pendingFile;

    if (!text && !hasMedia) return;

    const now     = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

    const list = document.getElementById('messagesList');

    // If there's a media file, send it first as its own bubble
    if (hasMedia) {
        const mediaMsg = {
            from: 'expert',
            type: pendingFile.type,   // 'image' or 'video'
            src:  pendingFile.objectUrl,
            time: timeStr,
        };
        rooms[currentRoom].messages.push(mediaMsg);
        list.appendChild(createMessageEl(mediaMsg, rooms[currentRoom]));
        removeMedia();
    }

    // If there's text, send it as a separate bubble
    if (text) {
        const textMsg = { from: 'expert', type: 'text', text, time: timeStr };
        rooms[currentRoom].messages.push(textMsg);
        list.appendChild(createMessageEl(textMsg, rooms[currentRoom]));
        input.value = '';
    }

    scrollToBottom();
    setInputDisabled(true);

    const typingDelay = 800  + Math.random() * 600;
    const replyDelay  = typingDelay + 1400 + Math.random() * 800;
    const roomSnapshot = currentRoom;

    setTimeout(() => {
        if (currentRoom === roomSnapshot && !rooms[roomSnapshot].ended) {
            showTypingIndicator(rooms[roomSnapshot]);
        }
    }, typingDelay);

    setTimeout(() => {
        if (currentRoom === roomSnapshot) {
            removeTypingIndicator();
            if (!rooms[roomSnapshot].ended) triggerDummyUserReply(roomSnapshot);
        }
        if (!rooms[currentRoom].ended) setInputDisabled(false);
    }, replyDelay);
}

// =============================================
// LIGHTBOX (full-view image / video)
// =============================================

function openLightbox(src, type) {
    const overlay = document.createElement('div');
    overlay.className = 'lightbox-overlay';

    let media;
    if (type === 'image') {
        media     = document.createElement('img');
        media.src = src;
        media.alt = 'Full view';
    } else {
        media          = document.createElement('video');
        media.src      = src;
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
}

function openAttachment() { /* replaced by toggleAttachMenu */ }
function openEmoji()      { console.log('Emoji — extend with emoji picker'); }
function openMoreOptions(){ console.log('More options — extend with dropdown'); }