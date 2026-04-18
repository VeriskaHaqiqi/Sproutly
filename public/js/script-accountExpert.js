/* =====================
   SIDEBAR TOGGLE
   — pola identik dengan script-manageSchedule.js
===================== */
(function () {
  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");  // <-- sama dengan manageSchedule
  const sidebarToggle = document.getElementById("sidebarToggle") || document.getElementById("menuToggle");

  if (!sidebar || !mainContent || !sidebarToggle) return;

  function openSidebar() {
    if (window.innerWidth <= 768) {
      sidebar.classList.add("show");
      sidebar.classList.remove("closed");
    } else {
      sidebar.classList.remove("closed");
      mainContent.classList.add("shifted");
      mainContent.classList.remove("full");
    }
    document.body.classList.add("sidebar-open");
  }

  function closeSidebar() {
    sidebar.classList.add("closed");
    sidebar.classList.remove("show");
    mainContent.classList.remove("shifted");
    mainContent.classList.add("full");
    document.body.classList.remove("sidebar-open");
  }

  function isSidebarOpen() {
    return window.innerWidth <= 768
      ? sidebar.classList.contains("show")
      : !sidebar.classList.contains("closed");
  }

  sidebarToggle.addEventListener("click", () =>
    isSidebarOpen() ? closeSidebar() : openSidebar()
  );

  document.querySelectorAll(".sidebar-menu .menu-link").forEach((link) => {
    link.addEventListener("click", () => closeSidebar());
  });

  document.addEventListener("click", (e) => {
    if (
      window.innerWidth <= 768 &&
      isSidebarOpen() &&
      !sidebar.contains(e.target) &&
      !sidebarToggle.contains(e.target)
    ) {
      closeSidebar();
    }
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      sidebar.classList.remove("show");
    } else {
      mainContent.classList.remove("shifted");
      mainContent.classList.add("full");
    }
  });

  // Halaman dibuka: sidebar tertutup
  sidebar.classList.add("closed");
})();


/* =====================
   SCROLL REVEAL
===================== */
const cards = document.querySelectorAll('.account-card');

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity   = '1';
      entry.target.style.transform = 'translateY(0)';
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.08 });

cards.forEach(card => observer.observe(card));