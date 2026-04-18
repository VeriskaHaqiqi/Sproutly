document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileToggle = document.getElementById("mobileToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    function openMobileSidebar() {
        sidebar.classList.add("show");
        if (sidebarOverlay) {
            sidebarOverlay.classList.add("show");
        }
    }

    function closeMobileSidebar() {
        sidebar.classList.remove("show");
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove("show");
        }
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function (e) {
            e.stopPropagation();

            if (window.innerWidth > 768) {
                sidebar.classList.toggle("closed");
                mainContent.classList.toggle("full");
            }
        });
    }

    if (mobileToggle) {
        mobileToggle.addEventListener("click", function (e) {
            e.stopPropagation();

            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains("show")) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", function () {
            closeMobileSidebar();
        });
    }

    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            const clickedInsideSidebar = sidebar.contains(e.target);
            const clickedMobileButton = mobileToggle && mobileToggle.contains(e.target);

            if (!clickedInsideSidebar && !clickedMobileButton) {
                closeMobileSidebar();
            }
        }
    });

    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            closeMobileSidebar();
        } else {
            sidebar.classList.remove("closed");
            mainContent.classList.remove("full");
        }
    });
});