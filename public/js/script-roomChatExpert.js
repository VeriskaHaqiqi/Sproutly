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
        messages: [
            { from: 'user',   type: 'text',  text: 'Hi expert, my tomato plants have these weird brown spots on the lower leaves. What should I do?', time: '10:12 AM' },
            { from: 'user',   type: 'image', src: 'image/tomato-plant.png', time: '10:13 AM' },
            { from: 'expert', type: 'text',  text: 'Hello Sarah! Looking at the image, it looks like early blight. This is common in tomatoes. How often are you watering them?', time: '10:15 AM • Expert' },
            { from: 'user',   type: 'text',  text: 'I water them once every morning. Should I reduce it?', time: '10:16 AM' },
            { from: 'expert', type: 'text',  text: "It's better to water the soil directly, avoiding the leaves. Try switching to deep watering every 2-3 days instead. I'll send you a guide on blight management.", time: '10:18 AM • Expert' },
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
        messages: [
            { from: 'user',   type: 'text', text: 'Hi, my hydroponic system keeps fluctuating in pH between 5.2 and 7.1. Is this normal?', time: '9:00 AM' },
            { from: 'expert', type: 'text', text: 'Hi Marcus! That range is too wide — ideal pH for most hydro plants is 5.5 to 6.5. Fluctuation beyond that can lock out nutrients.', time: '9:05 AM • Expert' },
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
        messages: [
            { from: 'user',   type: 'text', text: 'We have been noticing small white bugs on our grape leaves. Could these be mealybugs?', time: 'Yesterday 2:00 PM' },
            { from: 'expert', type: 'text', text: 'Hi Elena! Yes, those are very likely mealybugs. You can identify them by the white waxy coating they produce. A neem oil spray solution works well for vineyards.', time: 'Yesterday 2:15 PM • Expert' },
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
        messages: [
            { from: 'user',   type: 'text', text: 'Hello, my Phalaenopsis orchid roots are turning black and mushy. I think it might be root rot.', time: '7:30 AM' },
            { from: 'expert', type: 'text', text: 'Hello Dr. James! Root rot in orchids is usually caused by overwatering or poor drainage. Have you been watering more frequently than usual?', time: '7:35 AM • Expert' },
            { from: 'user',   type: 'text', text: 'I water it twice a week. The pot does have drainage holes.', time: '7:38 AM' },
            { from: 'expert', type: 'text', text: "Twice a week might be too much — orchids usually only need watering when the roots appear silvery-white. Remove the affected roots with sterilized scissors and repot in fresh bark medium.", time: '7:42 AM • Expert' },
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
        messages: [
            { from: 'user',   type: 'text', text: 'Hi! I want to propagate my lavender through cuttings but they keep drying out before they root. Any tips?', time: '5:00 AM' },
            { from: 'expert', type: 'text', text: 'Hello Dr. Emma! Lavender cuttings need very high humidity to root well. Try covering them with a clear plastic bag or a humidity dome after sticking them in the medium.', time: '5:10 AM • Expert' },
            { from: 'user',   type: 'text', text: 'What medium do you recommend? I have been using regular potting mix.', time: '5:14 AM' },
            { from: 'expert', type: 'text', text: 'Switch to a 50/50 mix of perlite and coarse sand. Regular potting mix retains too much moisture and can cause the base of the cutting to rot before rooting occurs.', time: '5:18 AM • Expert' },
        ],
    },
};

// =============================================
// DUMMY USER REPLIES PER ROOM
// =============================================

const dummyReplies = {
    sarah: [
        'Thank you so much! I will try that right away.',
        'Should I remove the affected leaves first?',
        'Got it, deep watering every 2-3 days. Noted!',
        'I really appreciate your help, this is very helpful.',
        'One more question — should I apply any fungicide?',
        'The spots seem to be spreading a little. Is that normal at this stage?',
    ],
    marcus: [
        'Ah I see, so my range is too wide. What should I adjust first?',
        'I will check my reservoir and nutrient solution.',
        'Should I do a full water change or just top it up?',
        'Thank you, I will try buffering it with pH down slowly.',
        'How long does it usually take for plants to recover after pH correction?',
    ],
    elena: [
        'Neem oil — okay I will get that this weekend.',
        'How diluted should the neem oil solution be?',
        'Should I spray in the morning or evening?',
        'I noticed some on the stems too, is that bad?',
        'Thank you! I hope we can get this under control before harvest.',
    ],
    james: [
        'I will trim the rotted roots today and repot.',
        'Should I let the roots dry out a bit before repotting?',
        'What bark medium do you recommend for Phalaenopsis?',
        'Good to know about the silvery-white color indicator, very helpful!',
        'Should I apply any fungicide to the cut roots?',
    ],
    emma: [
        'Perlite and coarse sand mix, got it! I will try that.',
        'How long does lavender usually take to root from cuttings?',
        'Should I use rooting hormone powder?',
        'The humidity dome idea sounds great, I will set that up.',
        'Thank you! My lavender garden is going to thrive with your tips.',
    ],
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
    setInputDisabled(false);
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
    row.className = `message-row ${msg.from === 'user' ? 'user-row' : 'expert-row'}`;

    if (msg.from === 'user') {
        // --- Avatar shell (inisial + foto overlay) ---
        const shell = document.createElement('div');
        shell.className          = 'msg-avatar-shell';
        shell.dataset.initials   = room.initials;
        shell.style.background   = avatarGradient(room.colorIdx);

        const avatarImg = document.createElement('img');
        avatarImg.src       = room.avatar;
        avatarImg.alt       = room.name;
        avatarImg.className = 'avatar-img';
        avatarImg.onerror   = () => { avatarImg.style.display = 'none'; };
        shell.appendChild(avatarImg);

        // --- Bubble ---
        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        if (msg.type === 'image') {
            const msgImg     = document.createElement('img');
            msgImg.src       = msg.src;
            msgImg.className = 'msg-image';
            msgImg.alt       = 'User image';
            msgImg.onerror   = () => { msgImg.style.display = 'none'; };
            bubble.appendChild(msgImg);
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
        // --- Expert icon circle dengan SVG leaf inline ---
        const iconCircle = document.createElement('div');
        iconCircle.className = 'expert-icon-circle';
        iconCircle.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M11 20A7 7 0 0 1 4 13c0-4 3-9 8-11 5 2 8 7 8 11a7 7 0 0 1-7 7z"/>
                <path d="M11 20c0-4 2-8 4-10"/>
            </svg>`;

        const bubble       = document.createElement('div');
        bubble.className   = 'bubble';
        bubble.textContent = msg.text;

        const timeEl       = document.createElement('span');
        timeEl.className   = 'bubble-time';
        timeEl.textContent = msg.time;
        bubble.appendChild(timeEl);

        row.appendChild(iconCircle);
        row.appendChild(bubble);
    }

    return row;
}

// =============================================
// UPDATE HEADER
// =============================================

function updateHeader(roomKey) {
    const room = rooms[roomKey];

    // Avatar shell di header
    const shell = document.getElementById('headerAvatarShell');
    if (shell) {
        shell.dataset.initials = room.initials;
        shell.style.background = avatarGradient(room.colorIdx);
    }

    // Foto avatar di header
    const headerImg = document.getElementById('headerAvatarImg');
    if (headerImg) {
        headerImg.src     = room.avatar;
        headerImg.style.display = '';
        headerImg.onerror = () => { headerImg.style.display = 'none'; };
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
    const input = document.getElementById('messageInput');
    const text  = input.value.trim();
    if (!text) return;

    const now     = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }) + ' • Expert';

    const msg = { from: 'expert', type: 'text', text, time: timeStr };

    rooms[currentRoom].messages.push(msg);

    const list = document.getElementById('messagesList');
    list.appendChild(createMessageEl(msg, rooms[currentRoom]));

    input.value = '';
    scrollToBottom();
    setInputDisabled(true);

    const typingDelay = 800  + Math.random() * 600;
    const replyDelay  = typingDelay + 1400 + Math.random() * 800;

    const roomSnapshot = currentRoom; // snapshot agar tidak terpengaruh switch room

    setTimeout(() => {
        if (currentRoom === roomSnapshot) showTypingIndicator(rooms[roomSnapshot]);
    }, typingDelay);

    setTimeout(() => {
        if (currentRoom === roomSnapshot) {
            removeTypingIndicator();
            triggerDummyUserReply(roomSnapshot);
        }
        setInputDisabled(false);
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

function openAttachment() { console.log('Attachment — extend with file picker'); }
function openEmoji()      { console.log('Emoji — extend with emoji picker'); }
function openMoreOptions(){ console.log('More options — extend with dropdown'); }