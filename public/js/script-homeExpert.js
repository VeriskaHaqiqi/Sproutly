// public/js/script-homeExpert.js

document.addEventListener("DOMContentLoaded", () => {

    // =====================
    // SIDEBAR
    // =====================
    (function () {
        const sidebar        = document.getElementById("sidebar");
        const mainArea       = document.getElementById("mainArea");
        const sidebarToggle  = document.getElementById("sidebarToggle");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        if (!sidebar || !mainArea || !sidebarToggle) return;

        const MOBILE_BP = 768;

        function isMobile() {
            return window.innerWidth <= MOBILE_BP;
        }

        function isSidebarOpen() {
            return !sidebar.classList.contains("closed");
        }

        function openSidebar() {
            sidebar.classList.remove("closed");
            document.body.classList.add("sidebar-open");

            if (isMobile()) {
                // Mobile: overlay appears, main area stays
                if (sidebarOverlay) sidebarOverlay.classList.add("active");
            }
            // Desktop: body.sidebar-open shifts .main-area via CSS margin-left
        }

        function closeSidebar() {
            sidebar.classList.add("closed");
            document.body.classList.remove("sidebar-open");
            if (sidebarOverlay) sidebarOverlay.classList.remove("active");
        }

        // Toggle on burger click
        sidebarToggle.addEventListener("click", () => {
            isSidebarOpen() ? closeSidebar() : openSidebar();
        });

        // Close when clicking overlay (mobile)
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener("click", closeSidebar);
        }

        // Close when nav link clicked (mobile)
        document.querySelectorAll(".sidebar-menu .menu-link").forEach((link) => {
            link.addEventListener("click", () => {
                if (isMobile()) closeSidebar();
            });
        });

        // On resize: if going desktop, remove overlay; if going mobile, remove margin shift
        window.addEventListener("resize", () => {
            if (!isMobile()) {
                if (sidebarOverlay) sidebarOverlay.classList.remove("active");
            }
        });

        // Start with sidebar closed
        sidebar.classList.add("closed");
        document.body.classList.remove("sidebar-open");
    })();


    // =====================
    // ENTRANCE ANIMATIONS
    // =====================
    const heroCard    = document.querySelector(".hero-card");
    const actionCards = document.querySelectorAll(".action-card");

    if (heroCard) {
        heroCard.style.opacity    = "0";
        heroCard.style.transform  = "translateY(18px)";
        heroCard.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        requestAnimationFrame(() => {
            setTimeout(() => {
                heroCard.style.opacity   = "1";
                heroCard.style.transform = "translateY(0)";
            }, 80);
        });
    }

    actionCards.forEach((card, i) => {
        card.style.opacity    = "0";
        card.style.transform  = "translateY(22px)";
        card.style.transition = `opacity 0.5s ease ${0.18 + i * 0.1}s, transform 0.5s ease ${0.18 + i * 0.1}s`;
        requestAnimationFrame(() => {
            setTimeout(() => {
                card.style.opacity   = "1";
                card.style.transform = "translateY(0)";
            }, 100 + i * 80);
        });
    });


    // =====================
    // BUTTON RIPPLE EFFECT
    // =====================
    const style = document.createElement("style");
    style.textContent = `@keyframes rippleAnim { to { transform: scale(2.5); opacity: 0; } }`;
    document.head.appendChild(style);

    document.querySelectorAll(".card-btn").forEach(btn => {
        btn.addEventListener("click", function (e) {
            const ripple = document.createElement("span");
            const rect   = this.getBoundingClientRect();
            const size   = Math.max(rect.width, rect.height);
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px; height: ${size}px;
                top: ${e.clientY - rect.top - size / 2}px;
                left: ${e.clientX - rect.left - size / 2}px;
                background: rgba(255,255,255,0.4);
                border-radius: 50%;
                transform: scale(0);
                animation: rippleAnim 0.5s ease-out forwards;
                pointer-events: none;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 520);
        });
    });

});