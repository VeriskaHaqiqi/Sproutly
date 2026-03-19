document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("show");
            } else {
                sidebar.classList.toggle("closed");
                mainContent.classList.toggle("full");
            }
        });
    }

    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove("show");
        } else {
            sidebar.classList.remove("closed");
            mainContent.classList.remove("full");
        }
    });

    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            const clickedInsideSidebar = sidebar.contains(e.target);
            const clickedToggle = sidebarToggle.contains(e.target);

            if (!clickedInsideSidebar && !clickedToggle) {
                sidebar.classList.remove("show");
            }
        }
    });
});