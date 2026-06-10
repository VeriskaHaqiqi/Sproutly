// ── Sidebar toggle (sama pola dengan articleExpert.js) ────────
const sidebar      = document.getElementById("sidebar");
const mainContent  = document.getElementById("mainContent");
const sidebarToggle = document.getElementById("sidebarToggle");

function openSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("show"); sidebar.classList.remove("closed");
  } else {
    sidebar.classList.remove("closed");
    mainContent.classList.add("shifted"); mainContent.classList.remove("full");
  }
}

function closeSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.remove("show"); sidebar.classList.add("closed");
  } else {
    sidebar.classList.add("closed");
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
  }
}

function isSidebarOpen() {
  return window.innerWidth <= 768
    ? sidebar.classList.contains("show")
    : !sidebar.classList.contains("closed");
}

sidebarToggle.addEventListener("click", () => {
  isSidebarOpen() ? closeSidebar() : openSidebar();
});

// Close on outside click (mobile)
document.addEventListener("click", (e) => {
  if (
    window.innerWidth <= 768 && isSidebarOpen() &&
    !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)
  ) closeSidebar();
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    sidebar.classList.remove("show");
  } else {
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
  }
});

// ── Set today's date ──────────────────────────────────────────
(function () {
  const el = document.getElementById("todayDate");
  if (!el) return;
  const now = new Date();
  el.textContent = now.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });
})();

// ── Init layout — default closed ─────────────────────────────
// Sidebar starts closed; menu-link clicks close it then navigate
document.querySelectorAll(".menu-link").forEach((link) => {
  link.addEventListener("click", () => {
    sidebar.classList.add("closed");
    sidebar.classList.remove("show");
    mainContent.classList.remove("shifted");
    mainContent.classList.add("full");
  });
});