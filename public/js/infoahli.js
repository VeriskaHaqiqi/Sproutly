document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileToggle = document.getElementById("mobileToggle");
    const mainContent = document.getElementById("mainContent");

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
});