/**
 * script-homeUser.js — Sproutly Home Page
 * Handles: Sidebar toggle, Date badge
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ========================
       SIDEBAR TOGGLE
    ======================== */
    const menuToggle     = document.getElementById('hamburgerBtn');
    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const pageWrapper = document.querySelector('.page-wrapper');

    function openSidebar() {
        sidebar.classList.remove('closed');
        if (menuToggle) menuToggle.classList.add('active');
        if (pageWrapper && window.innerWidth > 900) {
            pageWrapper.classList.add('sidebar-open');
        }
        if (window.innerWidth <= 900) {
            // Mobile: gunakan overlay, bukan push
            if (sidebarOverlay) sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeSidebar() {
        sidebar.classList.add('closed');
        if (menuToggle) menuToggle.classList.remove('active');
        if (pageWrapper) pageWrapper.classList.remove('sidebar-open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    function isSidebarOpen() {
        return !sidebar.classList.contains('closed');
    }

    // Hamburger button
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            isSidebarOpen() ? closeSidebar() : openSidebar();
        });
    }

    // Klik overlay → tutup sidebar
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Tombol Escape → tutup sidebar
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isSidebarOpen()) closeSidebar();
    });

    // Klik menu link → tutup sidebar otomatis (mobile)
    document.querySelectorAll('.menu-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 900) closeSidebar();
        });
    });

    // Reset overflow saat resize ke desktop
    window.addEventListener('resize', function () {
    if (window.innerWidth > 900) {
        document.body.style.overflow = '';
        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
        // Re-apply push jika sidebar sedang terbuka
        if (pageWrapper && !sidebar.classList.contains('closed')) {
            pageWrapper.classList.add('sidebar-open');
        }
    } else {
        if (pageWrapper) pageWrapper.classList.remove('sidebar-open');
    }
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