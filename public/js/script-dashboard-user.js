const menuToggle = document.getElementById("menuToggle");
const sidebar = document.getElementById("sidebar");
const sidebarMenu = document.getElementById("sidebarMenu");
const viewAllBtn = document.getElementById("viewAllBtn");
const hiddenWeekItems = document.querySelectorAll(".hidden-week");

let sidebarOpen = false;
let expandedActivities = false;

function updateSidebarState() {
  if (sidebarOpen) {
    sidebar.classList.add("open");
  } else {
    sidebar.classList.remove("open");
  }
}

menuToggle.addEventListener("click", () => {
  sidebarOpen = !sidebarOpen;
  updateSidebarState();
});

document.addEventListener("click", (event) => {
  const clickedInsideSidebar = sidebar.contains(event.target);
  const clickedToggle = menuToggle.contains(event.target);

  if (window.innerWidth <= 780 && sidebarOpen && !clickedInsideSidebar && !clickedToggle) {
    sidebarOpen = false;
    updateSidebarState();
  }
});

sidebarMenu.addEventListener("click", (event) => {
  const clickedItem = event.target.closest(".menu-item");
  if (!clickedItem) return;

  document.querySelectorAll(".menu-item").forEach((item) => {
    item.classList.remove("active");
  });

  clickedItem.classList.add("active");
});

viewAllBtn.addEventListener("click", () => {
  expandedActivities = !expandedActivities;

  hiddenWeekItems.forEach((item) => {
    if (expandedActivities) {
      item.classList.add("show");
    } else {
      item.classList.remove("show");
    }
  });

  viewAllBtn.textContent = expandedActivities ? "Show Less" : "View All";
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 780) {
    // biarkan state sidebar tetap
  } else if (!sidebarOpen) {
    sidebar.classList.remove("open");
  }
});

updateSidebarState();