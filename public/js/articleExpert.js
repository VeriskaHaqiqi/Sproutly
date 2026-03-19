const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const sidebarToggle = document.getElementById('sidebarToggle');

sidebarToggle.addEventListener('click', function () {
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('show');
    } else {
        sidebar.classList.toggle('closed');
        mainContent.classList.toggle('full');
    }
});

window.addEventListener('resize', function () {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('show');
    } else {
        sidebar.classList.remove('closed');
        mainContent.classList.remove('full');
    }
});