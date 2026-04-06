document.addEventListener('DOMContentLoaded', () => {
    // Select elements
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebarExpert');
    const overlay = document.getElementById('sidebarOverlay');
    const body = document.body;

    /**
     * Function: Open Sidebar
     */
    const openSidebar = () => {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        body.classList.add('sidebar-open');
        
        // Prevent body scrolling when menu is open
        body.style.overflow = 'hidden';
    };

    /**
     * Function: Close Sidebar
     */
    const closeSidebar = () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        body.classList.remove('sidebar-open');
        
        // Restore scrolling
        body.style.overflow = 'auto';
    };

    /**
     * Listeners
     */
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            openSidebar();
        });
    }

    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', closeSidebar);
    }

    // Close when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close when clicking escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });

    // Sub-interaction: FAQ Hover (Subtle border)
    const faqCards = document.querySelectorAll('.faq-card');
    faqCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.border = '1px solid #76ead0';
        });
        card.addEventListener('mouseleave', () => {
            card.style.border = 'none';
        });
    });
});