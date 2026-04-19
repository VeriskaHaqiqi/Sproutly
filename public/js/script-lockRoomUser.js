(function () {
    'use strict';

    // ── Pay Now button ──────────────────────────────────────────
    const payBtn = document.getElementById('payBtn');

    if (payBtn) {
        payBtn.addEventListener('click', function (event) {
            event.preventDefault();

            const href = payBtn.getAttribute('href');
            if (!href) return;

            payBtn.textContent = 'Redirecting…';
            payBtn.style.pointerEvents = 'none';
            payBtn.style.opacity = '0.8';

            setTimeout(function () {
                window.location.href = href;
            }, 200);
        });
    }

    // ── Cancel button ───────────────────────────────────────────
    const cancelBtn = document.getElementById('cancelBtn');

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function (event) {
            event.preventDefault();

            const href = cancelBtn.getAttribute('href');
            if (!href) return;

            window.location.href = href;
        });
    }

})();