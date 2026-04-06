(function () {
    'use strict';

    const payBtn = document.getElementById('payBtn');

    if (!payBtn) return;

    payBtn.addEventListener('click', function (event) {
        event.preventDefault();

        const href = payBtn.getAttribute('href');
        if (!href) return;

        payBtn.textContent = 'Redirecting...';
        payBtn.style.pointerEvents = 'none';
        payBtn.style.opacity = '0.85';

        setTimeout(function () {
            window.location.href = href;
        }, 200);
    });
})();