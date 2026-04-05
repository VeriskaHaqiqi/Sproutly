document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    function closeSidebarDesktop() {
        if (sidebar && mainContent) {
            sidebar.classList.add("hidden");
            mainContent.classList.add("full");
        }
    }

    function openSidebarDesktop() {
        if (sidebar && mainContent) {
            sidebar.classList.remove("hidden");
            mainContent.classList.remove("full");
        }
    }

    function closeSidebarMobile() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove("show");
            sidebarOverlay.classList.remove("show");
        }
    }

    function openSidebarMobile() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.add("show");
            sidebarOverlay.classList.add("show");
        }
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains("show")) {
                    closeSidebarMobile();
                } else {
                    openSidebarMobile();
                }
            } else {
                if (sidebar.classList.contains("hidden")) {
                    openSidebarDesktop();
                } else {
                    closeSidebarDesktop();
                }
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", function () {
            closeSidebarMobile();
        });
    }
});