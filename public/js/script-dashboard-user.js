const menuToggle  = document.getElementById("menuToggle");
const sidebar     = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");
const viewAllBtn  = document.getElementById("viewAllBtn");
const hiddenItems = document.querySelectorAll(".hidden-week");

let expanded = false;

function openSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("show");
    sidebar.classList.remove("closed");
  } else {
    sidebar.classList.remove("closed");
    mainContent.classList.add("shifted");
    mainContent.classList.remove("full");
  }
}

function closeSidebar() {
  sidebar.classList.add("closed");
  sidebar.classList.remove("show");
  mainContent.classList.remove("shifted");
  mainContent.classList.add("full");
}

function isSidebarOpen() {
  if (window.innerWidth <= 768) return sidebar.classList.contains("show");
  return !sidebar.classList.contains("closed");
}

// Toggle hamburger
menuToggle.addEventListener("click", () => {
  isSidebarOpen() ? closeSidebar() : openSidebar();
});

// Klik menu link → tutup sidebar otomatis
document.querySelectorAll(".menu-link").forEach((link) => {
  link.addEventListener("click", () => closeSidebar());
});

// Klik di luar sidebar → tutup (mobile)
document.addEventListener("click", (e) => {
  if (
    window.innerWidth <= 768 &&
    isSidebarOpen() &&
    !sidebar.contains(e.target) &&
    !menuToggle.contains(e.target)
  ) {
    closeSidebar();
  }
});

// Reset saat resize
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    sidebar.classList.remove("show");
  } else {
    mainContent.classList.remove("shifted");
    mainContent.classList.add("full");
  }
});

// View All / Show Less
viewAllBtn.addEventListener("click", () => {
  expanded = !expanded;
  hiddenItems.forEach((item) => item.classList.toggle("show", expanded));
  viewAllBtn.textContent = expanded ? "Show Less" : "View All";
});