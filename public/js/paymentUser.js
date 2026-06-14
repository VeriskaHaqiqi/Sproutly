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
            let file = paymentProof && paymentProof.files.length > 0 ? paymentProof.files[0] : null;
            if (!file) {
                // Create a dummy File for testing/simulation convenience if none selected
                file = new File(["dummy transfer proof"], "bukti_transfer.png", {type: "image/png"});
            }

            const card = document.querySelector(".payment-summary-card");
            const expertId = card ? card.getAttribute("data-expert-id") : null;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            if (!expertId) {
                alert("Expert not selected.");
                return;
            }

            const formData = new FormData();
            formData.append("expert_id", expertId);
            formData.append("bukti_transfer", file);

            confirmPaymentBtn.disabled = true;
            confirmPaymentBtn.textContent = "Processing...";

            fetch("/paymentUser", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(data => {
                confirmPaymentBtn.disabled = false;
                confirmPaymentBtn.textContent = "Confirm Payment";

                if (data.success) {
                    if (paymentSuccessModal) {
                        paymentSuccessModal.classList.add("show");
                        const viewBtn = paymentSuccessModal.querySelector(".primary-link-btn");
                        if (viewBtn && data.konsultasi_id) {
                            viewBtn.href = `/roomChatUser?id=${data.konsultasi_id}`;
                        }
                    }
                } else {
                    alert(data.message || "Failed to submit payment proof.");
                }
            })
            .catch(error => {
                confirmPaymentBtn.disabled = false;
                confirmPaymentBtn.textContent = "Confirm Payment";
                console.error("Error submitting payment:", error);
                alert("An error occurred while submitting payment. Please try again.");
            });
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