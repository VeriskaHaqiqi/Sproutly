document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const consultationFee = document.getElementById("consultationFee");
    const updateFeeBtn = document.getElementById("updateFeeBtn");
    const successMessage = document.getElementById("successMessage");

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

    function formatRupiah(value) {
        const numberString = value.replace(/\D/g, "");
        if (!numberString) return "";

        return numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

    if (consultationFee) {
    consultationFee.addEventListener("input", function () {
        this.value = formatRupiah(this.value);
    });
}

    if (updateFeeBtn) {
        updateFeeBtn.addEventListener("click", function () {
            if (consultationFee.value.trim() === "") {
                alert("Please enter the consultation fee first.");
                return;
            }

            successMessage.classList.add("show");

            setTimeout(() => {
                successMessage.classList.remove("show");
            }, 2500);
        });
    }
});