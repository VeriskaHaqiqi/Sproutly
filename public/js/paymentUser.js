document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileToggle = document.getElementById("mobileToggle");
    const mainContent = document.getElementById("mainContent");
    const copyBtn = document.getElementById("copyBtn");
    const accountNumber = document.getElementById("accountNumber");
    const paymentProof = document.getElementById("paymentProof");
    const fileName = document.getElementById("fileName");

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            sidebar.classList.toggle("closed");
            mainContent.classList.toggle("full");
        });
    }

    if (mobileToggle) {
        mobileToggle.addEventListener("click", function (e) {
            e.stopPropagation();
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

    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove("show");
        } else {
            sidebar.classList.remove("closed");
            mainContent.classList.remove("full");
        }
    });

    if (copyBtn && accountNumber) {
        copyBtn.addEventListener("click", function () {
            const text = accountNumber.textContent.trim();

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