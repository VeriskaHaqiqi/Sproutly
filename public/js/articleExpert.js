document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileToggle = document.getElementById("mobileToggle");

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
            const insideSidebar = sidebar.contains(e.target);
            const clickedMobile = mobileToggle && mobileToggle.contains(e.target);

            if (!insideSidebar && !clickedMobile) {
                sidebar.classList.remove("show");
            }
        }
    });
});