document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const copyBtn = document.getElementById("copyBtn");
    const accountNumber = document.getElementById("accountNumber");

    const paymentProof = document.getElementById("paymentProof");
    const fileName = document.getElementById("fileName");
    const uploadError = document.getElementById("uploadError");

    const confirmPaymentBtn = document.getElementById("confirmPaymentBtn");

    const paymentSuccessModal = document.getElementById("paymentSuccessModal");
    const closePaymentModal = document.getElementById("closePaymentModal");

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

    if (copyBtn && accountNumber) {
        copyBtn.addEventListener("click", async function () {
            try {
                await navigator.clipboard.writeText(accountNumber.textContent.trim());
                copyBtn.textContent = "Copied";
                setTimeout(() => {
                    copyBtn.textContent = "Copy";
                }, 1500);
            } catch (error) {
                alert("Failed to copy account number.");
            }
        });
    }

    if (paymentProof && fileName) {
        paymentProof.addEventListener("change", function () {
            if (uploadError) {
                uploadError.textContent = "";
            }

            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = "";
            }
        });
    }

    if (confirmPaymentBtn) {
        confirmPaymentBtn.addEventListener("click", function () {
            if (paymentProof && paymentProof.files.length === 0) {
                if (uploadError) {
                    uploadError.textContent = "Please upload your payment proof first.";
                }
                return;
            }

            if (paymentSuccessModal) {
                paymentSuccessModal.classList.add("show");
            }
        });
    }

    if (closePaymentModal && paymentSuccessModal) {
        closePaymentModal.addEventListener("click", function () {
            paymentSuccessModal.classList.remove("show");
        });
    }

    if (paymentSuccessModal) {
        paymentSuccessModal.addEventListener("click", function (e) {
            if (e.target === paymentSuccessModal) {
                paymentSuccessModal.classList.remove("show");
            }
        });
    }
});