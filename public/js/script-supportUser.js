/* =============================================
   script-supportUser.js
   Sproutly - Support & Information User
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

    /* ============ NOTIFICATION BUTTON ============ */
    var notifBtn = document.getElementById('notifBtn');
    if (notifBtn) {
        notifBtn.addEventListener('click', function () {
            // Placeholder: open notification panel or navigate
            // Future: toggle a notification dropdown here
        });
    }

    /* ============ CTA BUTTON ============ */
    var ctaBtn = document.getElementById('ctaBtn');
    if (ctaBtn) {
        ctaBtn.addEventListener('click', function (e) {
            // Future: open contact support modal or navigate to support form
            // For now allow default href behavior
        });
    }

    /* ============ FAQ CARD HOVER LIFT ============ */
    var faqCards = document.querySelectorAll('.faq-card');
    faqCards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            card.style.transition = 'box-shadow 0.18s, transform 0.14s';
        });
    });

    /* ============ SMOOTH SCROLL (future anchor links) ============ */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ============ SCROLL REVEAL ============ */
    function revealOnScroll() {
        var elements = document.querySelectorAll('.faq-card, .rules-card, .cta-card');
        elements.forEach(function (el) {
            var rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 60) {
                el.style.opacity = '1';
                el.style.transform = el.classList.contains('faq-card') ? 'translateY(0)' : '';
            }
        });
    }

    // Set initial state for reveal
    document.querySelectorAll('.faq-card').forEach(function (el, i) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(16px)';
        el.style.transition = 'opacity 0.38s ease ' + (i * 0.06) + 's, transform 0.35s ease ' + (i * 0.06) + 's, box-shadow 0.18s, border-color 0.18s';
    });

    document.querySelectorAll('.rules-card, .cta-card').forEach(function (el) {
        el.style.opacity = '0';
        el.style.transition = 'opacity 0.42s ease 0.1s';
    });

    window.addEventListener('scroll', revealOnScroll, { passive: true });
    revealOnScroll(); // run once on load

});