const menuToggle = document.getElementById("menuToggle");
const sidebar = document.getElementById("sidebar");
const sidebarMenu = document.getElementById("sidebarMenu");
const topicWrap = document.getElementById("topicWrap");
const articleCards = document.querySelectorAll(".article-card");
const articleSearch = document.getElementById("articleSearch");
const searchButton = document.getElementById("searchButton");
const emptyState = document.getElementById("emptyState");
const bookmarkButtons = document.querySelectorAll(".bookmark-btn");

let sidebarOpen = false;
let activeTopic = "all";

function updateSidebarState() {
  if (sidebarOpen) {
    sidebar.classList.add("open");
  } else {
    sidebar.classList.remove("open");
  }
}

if (menuToggle) {
  menuToggle.addEventListener("click", () => {
    sidebarOpen = !sidebarOpen;
    updateSidebarState();
  });
}

document.addEventListener("click", (event) => {
  if (!sidebar || !menuToggle) return;

  const clickedInsideSidebar = sidebar.contains(event.target);
  const clickedToggle = menuToggle.contains(event.target);

  if (window.innerWidth <= 780 && sidebarOpen && !clickedInsideSidebar && !clickedToggle) {
    sidebarOpen = false;
    updateSidebarState();
  }
});

if (sidebarMenu) {
  sidebarMenu.addEventListener("click", (event) => {
    const clickedItem = event.target.closest(".menu-item");
    if (!clickedItem) return;

    document.querySelectorAll(".menu-item").forEach((item) => {
      item.classList.remove("active");
    });

    clickedItem.classList.add("active");
  });
}

if (topicWrap) {
  topicWrap.addEventListener("click", (event) => {
    const clickedTopic = event.target.closest(".topic-chip");
    if (!clickedTopic) return;

    document.querySelectorAll(".topic-chip").forEach((chip) => {
      chip.classList.remove("active");
    });

    clickedTopic.classList.add("active");
    activeTopic = clickedTopic.dataset.topic;
    filterArticles();
  });
}

function filterArticles() {
  if (!articleSearch) return;

  const keyword = articleSearch.value.trim().toLowerCase();
  let visibleCount = 0;

  articleCards.forEach((card) => {
    const title = card.dataset.title.toLowerCase();
    const topic = card.dataset.topic.toLowerCase();
    const keywords = card.dataset.keywords.toLowerCase();
    const author = card.dataset.author.toLowerCase();

    const matchesTopic = activeTopic === "all" || topic === activeTopic;
    const matchesSearch =
      keyword === "" ||
      title.includes(keyword) ||
      topic.includes(keyword) ||
      keywords.includes(keyword) ||
      author.includes(keyword);

    const shouldShow = matchesTopic && matchesSearch;
    card.style.display = shouldShow ? "block" : "none";

    if (shouldShow) visibleCount++;
  });

  if (visibleCount === 0) {
    emptyState.classList.remove("hidden");
  } else {
    emptyState.classList.add("hidden");
  }
}

if (articleSearch) {
  articleSearch.addEventListener("input", filterArticles);
}

if (searchButton) {
  searchButton.addEventListener("click", filterArticles);
}

bookmarkButtons.forEach((button) => {
  button.addEventListener("click", () => {
    button.classList.toggle("bookmarked");
  });
});

window.addEventListener("resize", () => {
  if (window.innerWidth <= 780 && !sidebarOpen) {
    sidebar.classList.remove("open");
  }
});

updateSidebarState();
filterArticles();