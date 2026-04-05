/**
 * payment-verified.js
 * Sproutly – Payment Verified Notification
 *
 * Behaviour:
 *  - "Start Consultation" → hide modal, send auto message "may i help u"
 *    from botanist side, then focus input
 *  - "Close"             → hide modal, open chat WITHOUT auto message
 */

(function () {
    'use strict';

    /* ── DOM refs ── */
    const modal          = document.getElementById('paymentModal');
    const btnStart       = document.getElementById('btnStartConsultation');
    const btnClose       = document.getElementById('btnClose');
    const chatMessages   = document.getElementById('chatMessages');
    const messageInput   = document.getElementById('messageInput');
    const btnSend        = document.getElementById('btnSend');
    const toast          = document.getElementById('toast');

    /* ── Botanist meta (adjust to match Laravel auth) ── */
    const botanist = {
        name:   'Sarah Johnson',           // logged-in expert name
        avatar: '/image/sarah.png',        // expert avatar
    };

    /* ── Helper: current time HH:MM ── */
    function now() {
        return new Date().toLocaleTimeString('en-US', {
            hour:   '2-digit',
            minute: '2-digit',
            hour12: true,
        });
    }

    /* ── Helper: show toast ── */
    let toastTimer;
    function showToast(message, duration = 3000) {
        clearTimeout(toastTimer);
        toast.textContent = message;
        toast.classList.add('show');
        toastTimer = setTimeout(() => toast.classList.remove('show'), duration);
    }

    /* ── Append a message bubble ── */
    function appendMessage({ text, type = 'outgoing', avatarSrc = botanist.avatar, time = now() }) {
        const row = document.createElement('div');
        row.className = `message-row ${type}`;

        const bubble = document.createElement('div');
        bubble.className = 'message-bubble';
        bubble.textContent = text;

        const msgTime = document.createElement('div');
        msgTime.className = 'msg-time';
        msgTime.textContent = time;

        const wrapper = document.createElement('div');
        wrapper.style.cssText = 'display:flex;flex-direction:column;max-width:70%;';

        if (type === 'outgoing') {
            wrapper.style.alignItems = 'flex-end';
        } else {
            wrapper.style.alignItems = 'flex-start';

            // Add avatar for incoming messages
            const avatar = document.createElement('img');
            avatar.className = 'msg-avatar';
            avatar.src  = avatarSrc;
            avatar.alt  = 'User';
            avatar.onerror = () => {
                avatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(botanist.name)}&background=d0ff99&color=333&size=30`;
            };
            row.appendChild(avatar);
        }

        wrapper.appendChild(bubble);
        wrapper.appendChild(msgTime);
        row.appendChild(wrapper);
        chatMessages.appendChild(row);

        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    /* ── Send auto greeting from botanist ── */
    function sendAutoGreeting() {
        // Small delay so modal close animation finishes first
        setTimeout(() => {
            appendMessage({
                text: 'may i help u',
                type: 'outgoing',
                time: now(),
            });
        }, 400);
    }

    /* ── Close modal ── */
    function closeModal() {
        modal.classList.add('hidden');
        // Focus input after modal closes
        setTimeout(() => messageInput?.focus(), 200);
    }

    /* ── START CONSULTATION ── */
    function handleStartConsultation() {
        closeModal();
        sendAutoGreeting();
        showToast('✓ Consultation started — message sent');

        // Optional: notify server via AJAX
        const sessionId  = btnStart.dataset.sessionId;
        const csrfToken  = document.querySelector('meta[name="csrf-token"]')?.content;

        if (sessionId && csrfToken) {
            fetch('/consultation/start', {
                method:  'POST',
                headers: {
                    'Content-Type':  'application/json',
                    'X-CSRF-TOKEN':  csrfToken,
                    'Accept':        'application/json',
                },
                body: JSON.stringify({
                    session_id:   sessionId,
                    auto_message: 'may i help u',
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .catch(() => {/* silent — message already shown locally */});
        }
    }

    /* ── CLOSE (no auto message) ── */
    function handleClose() {
        closeModal();
        showToast('Chat opened — no auto message sent');
    }

    /* ── Manual message send ── */
    function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        appendMessage({ text, type: 'outgoing', time: now() });
        messageInput.value = '';
        messageInput.focus();
    }

    /* ── Event listeners ── */
    btnStart.addEventListener('click', handleStartConsultation);
    btnClose.addEventListener('click', handleClose);

    btnSend.addEventListener('click', sendMessage);

    messageInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    /* ── Close modal on backdrop click ── */
    modal.addEventListener('click', (e) => {
        if (e.target === modal) handleClose();
    });

    /* ── Close modal on Escape ── */
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            handleClose();
        }
    });

    /* ── Sidebar chat item switching (UI only) ── */
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', function () {
            document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

})();