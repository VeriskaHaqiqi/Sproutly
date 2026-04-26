/**
 * script-homeUser.js — Sproutly Home Page
 * Handles: Sidebar toggle, Date badge
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ========================
       SIDEBAR TOGGLE
    ======================== */
    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const hamburgerBtn   = document.getElementById('hamburgerBtn');

    function openSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('active');
        hamburgerBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
        hamburgerBtn.classList.remove('active');
        document.body.style.overflow = '';
    }

    function toggleSidebar() {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    }

    if (hamburgerBtn) hamburgerBtn.addEventListener('click', toggleSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });

    /* ========================
       SIDEBAR ACTIVE STATE
    ======================== */
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            menuItems.forEach(function (i) { i.classList.remove('active'); });
            item.classList.add('active');
            if (window.innerWidth < 900) setTimeout(closeSidebar, 200);
        });
    });

    /* ========================
       DATE BADGE
    ======================== */
    const dateEl = document.getElementById('greetingDate');
    if (dateEl) {
        const now    = new Date();
        const days   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
    }

});