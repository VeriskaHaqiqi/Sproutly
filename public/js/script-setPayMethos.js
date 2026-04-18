/* ============================================================
   set-payment-method.js
   Sproutly | Payment Method Settings – Expert
   ============================================================ */

(function () {
    'use strict';

    /* ── DOM references ── */
    const sidebar       = document.getElementById('sidebar');
    const mainContent   = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');

    const form              = document.getElementById('paymentForm');
    const btnSave           = document.getElementById('btnSave');
    const btnRemove         = document.getElementById('btnRemove');

    const fBankName         = document.getElementById('bankName');
    const fHolderName       = document.getElementById('holderName');
    const fAccountNumber    = document.getElementById('accountNumber');
    const fBranchName       = document.getElementById('branchName');
    const fInstructions     = document.getElementById('instructions');

    const previewEmpty      = document.getElementById('previewEmpty');
    const previewFilled     = document.getElementById('previewFilled');

    const prevHolderName    = document.getElementById('prevHolderName');
    const prevBankName      = document.getElementById('prevBankName');
    const prevAccountNumber = document.getElementById('prevAccountNumber');
    const prevBranchName    = document.getElementById('prevBranchName');
    const prevBranchRow     = document.getElementById('prevBranchRow');
    const prevInstructions  = document.getElementById('prevInstructions');
    const prevInstructionsTxt = document.getElementById('prevInstructionsText');

    const toast             = document.getElementById('toast');

    /* ================================================================
       1. SIDEBAR — auto-closed on page load, burger toggles open/close
    ================================================================ */
    function initSidebar() {
        if (!sidebar || !mainContent) return;

        /* Always start closed (desktop: slide left; mobile: hidden) */
        sidebar.classList.add('closed');
        mainContent.classList.add('full');

        if (!sidebarToggle) return;

        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                /* Mobile: toggle .show */
                sidebar.classList.toggle('show');
            } else {
                /* Desktop: toggle .closed / full */
                sidebar.classList.toggle('closed');
                mainContent.classList.toggle('full');
            }
        });

        /* On resize, clean up leftover classes */
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            } else {
                sidebar.classList.remove('closed');
                mainContent.classList.remove('full');
            }
        });
    }

    /* ================================================================
       2. SAVE — validate → show preview → show toast
    ================================================================ */
    function handleSave(e) {
        e.preventDefault();

        const bank    = fBankName.value.trim();
        const holder  = fHolderName.value.trim();
        const account = fAccountNumber.value.trim();
        const branch  = fBranchName.value.trim();
        const instr   = fInstructions.value.trim();

        /* Basic validation */
        if (!bank || !holder || !account) {
            shakeFields([
                !bank    ? fBankName    : null,
                !holder  ? fHolderName  : null,
                !account ? fAccountNumber : null,
            ].filter(Boolean));
            showToast('Please fill in all required fields.', true);
            return;
        }

        /* Populate preview */
        prevHolderName.textContent    = holder;
        prevBankName.textContent      = bank;
        prevAccountNumber.textContent = account;

        if (branch) {
            prevBranchName.textContent = branch;
            prevBranchRow.style.display = '';
        } else {
            prevBranchRow.style.display = 'none';
        }

        if (instr) {
            prevInstructionsTxt.textContent = instr;
            prevInstructions.style.display = '';
        } else {
            prevInstructions.style.display = 'none';
        }

        /* Swap empty → filled */
        previewEmpty.style.display  = 'none';
        previewFilled.style.display = '';

        showToast('Payment method saved successfully!', false);
    }

    /* ================================================================
       3. REMOVE — clear form + preview
    ================================================================ */
    function handleRemove() {
        if (!confirm('Remove your payment method? This cannot be undone.')) return;

        form.reset();

        previewFilled.style.display = 'none';
        previewEmpty.style.display  = '';

        showToast('Payment method removed.', false);
    }

    /* ================================================================
       4. TOAST helper
    ================================================================ */
    let toastTimer = null;

    function showToast(message, isError) {
        const icon = toast.querySelector('i');
        const span = toast.querySelector('span');

        span.textContent = message;

        if (isError) {
            icon.className = 'fa-solid fa-circle-exclamation';
            icon.style.color = '#ff6b6b';
        } else {
            icon.className = 'fa-solid fa-circle-check';
            icon.style.color = '#76ead0';
        }

        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.classList.remove('show'), 3200);
    }

    /* ================================================================
       5. FIELD SHAKE animation on validation error
    ================================================================ */
    function shakeFields(fields) {
        fields.forEach(el => {
            el.closest('.input-wrap, .field-group').classList.remove('shake');
            /* Force reflow */
            void el.offsetWidth;
            el.closest('.input-wrap, .field-group').classList.add('shake');
            el.style.borderColor = '#f87171';
            el.addEventListener('input', function clearError() {
                el.style.borderColor = '';
                el.removeEventListener('input', clearError);
            }, { once: true });
        });
    }

    /* ================================================================
       6. INIT
    ================================================================ */
    function init() {
        initSidebar();

        if (btnSave)   btnSave.addEventListener('click', handleSave);
        if (btnRemove) btnRemove.addEventListener('click', handleRemove);

        /* Also attach to form submit */
        if (form) form.addEventListener('submit', handleSave);
    }

    document.addEventListener('DOMContentLoaded', init);

})();