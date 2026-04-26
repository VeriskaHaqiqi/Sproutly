document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const searchInput = document.getElementById("searchInput");
    const requestCards = document.querySelectorAll(".request-card");

    function closeSidebarDesktop() {
        sidebar.classList.add("hidden");
        mainContent.classList.add("full");
    }

    function openSidebarDesktop() {
        sidebar.classList.remove("hidden");
        mainContent.classList.remove("full");
    }

    function closeSidebarMobile() {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    }

    function openSidebarMobile() {
        sidebar.classList.add("show");
        sidebarOverlay.classList.add("show");
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

    if (searchInput) {
        searchInput.addEventListener("input", function () {
            const keyword = this.value.toLowerCase().trim();

            requestCards.forEach((card) => {
                const text = card.innerText.toLowerCase();

                if (text.includes(keyword)) {
                    card.style.display = "flex";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

    requestCards.forEach((card) => {
        card.addEventListener("click", function () {
            window.location.href = this.dataset.url || "/roomChatExpert";
        });
    });
});