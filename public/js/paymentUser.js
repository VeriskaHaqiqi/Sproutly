document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileToggle = document.getElementById("mobileToggle");
    const copyBtn = document.getElementById("copyBtn");
    const accountNumber = document.getElementById("accountNumber");
    const paymentProof = document.getElementById("paymentProof");
    const fileName = document.getElementById("fileName");

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    }

    if (mobileToggle) {
        mobileToggle.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            const clickedInsideSidebar = sidebar.contains(e.target);
            const clickedMobileButton = mobileToggle && mobileToggle.contains(e.target);

            if (!clickedInsideSidebar && !clickedMobileButton) {
                sidebar.classList.remove("show");
            }
        }
    });

    if (copyBtn && accountNumber) {
        copyBtn.addEventListener("click", function () {
            const text = accountNumber.textContent;
            navigator.clipboard.writeText(text).then(() => {
                copyBtn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
                setTimeout(() => {
                    copyBtn.innerHTML = '<i class="fa-regular fa-copy"></i> Copy';
                }, 1500);
            });
        });
    }

    if (paymentProof && fileName) {
        paymentProof.addEventListener("change", function () {
            if (this.files.length > 0) {
                fileName.textContent = "Selected file: " + this.files[0].name;
            } else {
                fileName.textContent = "";
            }
        });
    }
});