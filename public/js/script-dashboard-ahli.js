document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebarExpert');
    const overlay = document.getElementById('sidebarOverlay');
    const mainContent = document.getElementById('mainContent');

    /**
     * TOGGLE SIDEBAR LOGIC
     */
    const toggleSidebar = () => {
        const isOpen = sidebar.classList.toggle('open');
        overlay.classList.toggle('active');

        // Jika sidebar terbuka, cegah scroll pada background (mobile)
        if (window.innerWidth <= 1024) {
            document.body.style.overflow = isOpen ? 'hidden' : 'auto';
        }
    };

    // 1. Klik Hamburger (Buka/Tutup)
    hamburgerBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Mencegah bubbling
        toggleSidebar();
    });

    // 2. Klik Overlay (Tutup Sidebar saat klik area luar)
    overlay.addEventListener('click', () => {
        if (sidebar.classList.contains('open')) {
            toggleSidebar();
        }
    });

    // 3. Tambahan: Tutup dengan tombol ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            toggleSidebar();
        }
    });

    /**
     * WINDOW RESIZE HANDLER
     * Memastikan state bersih saat ganti ukuran layar
     */
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    /**
     * CLICKABLE COMPONENTS LOGIC
     * Memastikan semua tombol memiliki feedback visual sederhana saat diklik
     */
    const viewAllLink = document.querySelector('.view-all-link');
    if (viewAllLink) {
        viewAllLink.addEventListener('click', () => {
            console.log('Redirecting to full consultation list...');
        });
    }

    const detailButtons = document.querySelectorAll('.btn-detail');
    detailButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Kita bisa menambahkan loader di sini jika perlu
            const url = btn.getAttribute('href');
            console.log(`Navigating to detail: ${url}`);
        });
    });
});