/**
 * payment-verified.js
 * Sproutly – Payment Verified Notification
 *
 * Behaviour:
 *  - "Start Consultation" → hide modal, send auto message "may i help u"
 *    from botanist side, then redirect ke roomChatExpert
 *  - "Close"             → hide modal, redirect ke roomChatExpert
 *                          WITHOUT auto message
 */

(function () {
    'use strict';

    /* ── DOM refs ── */
    const modal          = document.getElementById('paymentModal');
    const btnStart       = document.getElementById('btnStartConsultation');
    const btnClose       = document.getElementById('btnClose');
    const toast          = document.getElementById('toast');

    /* ── Helper: show toast ── */
    let toastTimer;
    function showToast(message, duration = 3000) {
        clearTimeout(toastTimer);
        toast.textContent = message;
        toast.classList.add('show');
        toastTimer = setTimeout(() => toast.classList.remove('show'), duration);
    }

    /* ── Close modal ── */
    function closeModal() {
        modal.classList.add('hidden');
    }

    /* ── START CONSULTATION ── */
    function handleStartConsultation() {
        closeModal();
        showToast('✓ Consultation started — redirecting...');

        setTimeout(() => {
            window.location.href = window.ROUTES.roomChatExpert;
        }, 800); // beri waktu toast tampil sebentar sebelum redirect
    }

    /* ── CLOSE (no auto message) ── */
    function handleClose() {
        closeModal();
        window.location.href = window.ROUTES.roomChatExpert;
    }

    /* ── Event listeners ── */
    btnStart.addEventListener('click', handleStartConsultation);
    btnClose.addEventListener('click', handleClose);

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