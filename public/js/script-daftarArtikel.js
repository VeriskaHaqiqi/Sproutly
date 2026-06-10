const topicWrap    = document.getElementById("topicWrap");
const articleCards = document.querySelectorAll(".article-card");
const articleSearch = document.getElementById("articleSearch");
const searchButton  = document.getElementById("searchButton");
const emptyState    = document.getElementById("emptyState");
const bookmarkBtns  = document.querySelectorAll(".bookmark-btn");

let activeTopic = "all";

// ── Filter ────────────────────────────────────────
function filterArticles() {
  const keyword = (articleSearch?.value || "").trim().toLowerCase();
  let visible = 0;

  articleCards.forEach((card) => {
    const matchesTopic  = activeTopic === "all" || card.dataset.topic === activeTopic;
    const matchesSearch = !keyword ||
      card.dataset.title.toLowerCase().includes(keyword) ||
      card.dataset.topic.toLowerCase().includes(keyword) ||
      card.dataset.keywords.toLowerCase().includes(keyword) ||
      card.dataset.author.toLowerCase().includes(keyword);

    const show = matchesTopic && matchesSearch;
    card.style.display = show ? "block" : "none";
    if (show) visible++;
  });

  emptyState.classList.toggle("hidden", visible > 0);
}

topicWrap?.addEventListener("click", (e) => {
  const chip = e.target.closest(".topic-chip");
  if (!chip) return;
  document.querySelectorAll(".topic-chip").forEach(c => c.classList.remove("active"));
  chip.classList.add("active");
  activeTopic = chip.dataset.topic;
  filterArticles();
});

articleSearch?.addEventListener("input", filterArticles);
searchButton?.addEventListener("click", filterArticles);

// ── Bookmark ──────────────────────────────────────
bookmarkBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault(); // jangan ikut link artikel
    e.stopPropagation();
    btn.classList.toggle("bookmarked");
  });
});

// ── Init ──────────────────────────────────────────
filterArticles();

// ── Sidebar toggle ────────────────────────────────
(function () {
  const sidebar     = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const toggle      = document.getElementById("menuToggle");
  if (!sidebar || !mainContent || !toggle) return;

  function open() {
    if (window.innerWidth <= 768) { sidebar.classList.add("show"); sidebar.classList.remove("closed"); }
    else { sidebar.classList.remove("closed"); mainContent.classList.add("shifted"); mainContent.classList.remove("full"); }
  }
  function close() {
    sidebar.classList.add("closed"); sidebar.classList.remove("show");
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
  }
  function isOpen() { return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed"); }

  toggle.addEventListener("click", () => isOpen() ? close() : open());
  document.querySelectorAll(".menu-link").forEach(l => l.addEventListener("click", close));
  document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768 && isOpen() && !sidebar.contains(e.target) && !toggle.contains(e.target)) close();
  });
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) sidebar.classList.remove("show");
    else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
  });
})();