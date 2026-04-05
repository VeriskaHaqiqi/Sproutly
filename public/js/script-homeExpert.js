// public/js/homeExpert.js

document.addEventListener("DOMContentLoaded", () => {

    // =====================
    // SIDEBAR
    // =====================
    const menuToggle  = document.getElementById("menuToggle");
    const sidebar     = document.getElementById("sidebar");
    const sidebarMenu = document.getElementById("sidebarMenu");
    const overlay     = document.getElementById("sidebarOverlay");

    let sidebarOpen = false;

    function updateSidebarState() {
        if (!sidebar) return;
        if (sidebarOpen) {
            sidebar.classList.add("open");
            if (overlay) overlay.classList.add("visible");
        } else {
            sidebar.classList.remove("open");
            if (overlay) overlay.classList.remove("visible");
        }
    }

    if (menuToggle) {
        menuToggle.addEventListener("click", () => {
            sidebarOpen = !sidebarOpen;
            updateSidebarState();
        });
    }

    if (overlay) {
        overlay.addEventListener("click", () => {
            sidebarOpen = false;
            updateSidebarState();
        });
    }

    document.addEventListener("click", (event) => {
        if (!sidebar || !menuToggle) return;
        const clickedInsideSidebar = sidebar.contains(event.target);
        const clickedToggle = menuToggle.contains(event.target);
        if (window.innerWidth <= 780 && sidebarOpen && !clickedInsideSidebar && !clickedToggle) {
            sidebarOpen = false;
            updateSidebarState();
        }
    });

    if (sidebarMenu) {
        sidebarMenu.addEventListener("click", (event) => {
            const clickedItem = event.target.closest(".menu-item");
            if (!clickedItem) return;
            document.querySelectorAll(".menu-item").forEach((item) => {
                item.classList.remove("active");
            });
            clickedItem.classList.add("active");
        });
    }

    window.addEventListener("resize", () => {
        if (!sidebar) return;
        if (window.innerWidth <= 780 && !sidebarOpen) {
            sidebar.classList.remove("open");
            if (overlay) overlay.classList.remove("visible");
        }
    });

    updateSidebarState();

    // =====================
    // ENTRANCE ANIMATIONS
    // =====================
    const heroCard    = document.querySelector(".hero-card");
    const actionCards = document.querySelectorAll(".action-card");

    if (heroCard) {
        heroCard.style.opacity   = "0";
        heroCard.style.transform = "translateY(18px)";
        heroCard.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        requestAnimationFrame(() => {
            setTimeout(() => {
                heroCard.style.opacity   = "1";
                heroCard.style.transform = "translateY(0)";
            }, 80);
        });
    }

    actionCards.forEach((card, i) => {
        card.style.opacity   = "0";
        card.style.transform = "translateY(22px)";
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
            if (getComputedStyle(this).position === "static") this.style.position = "relative";
            this.style.overflow = "hidden";
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 520);
        });
    });

});