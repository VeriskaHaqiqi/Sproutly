document.addEventListener("DOMContentLoaded", function () {

  // ── Sidebar toggle ───────────────────────────────
  const sidebar     = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const menuToggle  = document.getElementById("menuToggle");

  if (sidebar && mainContent && menuToggle) {
    function openSidebar() {
      if (window.innerWidth <= 768) { sidebar.classList.add("show"); sidebar.classList.remove("closed"); }
      else { sidebar.classList.remove("closed"); mainContent.classList.add("shifted"); mainContent.classList.remove("full"); }
    }
    function closeSidebar() {
      sidebar.classList.add("closed"); sidebar.classList.remove("show");
      mainContent.classList.remove("shifted"); mainContent.classList.add("full");
    }
    function isOpen() { return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed"); }
    menuToggle.addEventListener("click", () => isOpen() ? closeSidebar() : openSidebar());
    document.querySelectorAll(".menu-link").forEach(l => l.addEventListener("click", closeSidebar));
    document.addEventListener("click", (e) => {
      if (window.innerWidth <= 768 && isOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
    });
    window.addEventListener("resize", () => {
      if (window.innerWidth > 768) sidebar.classList.remove("show");
      else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
    });
  }

  // ── Original bookmark JS ─────────────────────────
  const filterToggle = document.getElementById("filterToggle");
  const filterPanel = document.getElementById("filterPanel");
  const articleSearch = document.getElementById("articleSearch");
  const topicFilters = document.querySelectorAll(".filter-chip");
  const sortSelect = document.getElementById("sortSelect");
  const resetFilters = document.getElementById("resetFilters");
  const articleGrid = document.getElementById("articleGrid");
  const emptyState = document.getElementById("emptyState");
  const paginationWrap = document.getElementById("paginationWrap");
  const totalSavedStat = document.getElementById("totalSavedStat");
  const topCategoryStat = document.getElementById("topCategoryStat");

  const ITEMS_PER_PAGE = 6;
  let currentPage = 1;
  let currentTopic = "all";
  let currentSearch = "";
  let currentSort = "latest";

  const bookmarkedKeys = JSON.parse(localStorage.getItem('bookmarked_articles') || '[]');
  const allArticles = window.ALL_ARTICLES || [
    { id: "irrigation", title: "Modern Irrigation Techniques for Water Conservation", topic: "Irrigation", date: "2024-03-15", displayDate: "Mar 15, 2024", author: "John Parker", description: "Learn how to optimize water usage with advanced drip irrigation systems and smart scheduling methods.", image: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80" },
    { id: "soil", title: "Building Healthy Soil Through Composting", topic: "Soil Health", date: "2024-03-14", displayDate: "Mar 14, 2024", author: "Sarah Mitchell", description: "Discover the benefits of composting and how to create nutrient-rich soil for improved crop growth.", image: "https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?w=800&q=80" },
    { id: "pest", title: "Organic Pest Management Strategies", topic: "Pest Control", date: "2024-03-13", displayDate: "Mar 13, 2024", author: "Michael Chen", description: "Explore natural and effective methods to protect your crops without harmful chemical pesticides.", image: "https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=800&q=80" },
    { id: "drone", title: "Using Drones for Precision Agriculture", topic: "Technology", date: "2024-03-12", displayDate: "Mar 12, 2024", author: "David Rodriguez", description: "How aerial technology is revolutionizing crop monitoring and field management practices.", image: "https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=800&q=80" },
    { id: "rotation", title: "Crop Rotation for Long-Term Sustainability", topic: "Sustainability", date: "2024-03-11", displayDate: "Mar 11, 2024", author: "Emma Thompson", description: "Master the art of crop rotation to maintain soil fertility and reduce disease pressure over time.", image: "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800&q=80" },
    { id: "climate", title: "Climate-Smart Farming Practices", topic: "Crop Management", date: "2024-03-10", displayDate: "Mar 10, 2024", author: "James Wilson", description: "Adapt your farming methods to changing weather patterns and build resilience against climate challenges.", image: "https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=800&q=80" },
    { id: "hydroponic", title: "Introduction to Hydroponic Farming", topic: "Technology", date: "2024-03-09", displayDate: "Mar 09, 2024", author: "Lisa Anderson", description: "Explore soil-less growing systems that maximize space efficiency and water conservation.", image: "https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=800&q=80" },
    { id: "nutrients", title: "Understanding Soil Nutrients and Fertilization", topic: "Soil Health", date: "2024-03-08", displayDate: "Mar 08, 2024", author: "Robert Martinez", description: "Learn how to test soil and apply the right nutrients for optimal plant growth and health.", image: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80" },
    { id: "rainwater", title: "Rainwater Harvesting for Farm Use", topic: "Irrigation", date: "2024-03-07", displayDate: "Mar 07, 2024", author: "Olivia Green", description: "Implement effective rainwater collection systems to reduce dependency on external water sources.", image: "https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=800&q=80" }
  ];
  const articles = allArticles;

  function topicClass(topic) { return `topic-${topic.toLowerCase().replace(/\s+/g, "-")}`; }
  function normalizeText(text) { return text.toLowerCase().trim(); }

  function getFilteredArticles() {
    let filtered = [...articles];
    if (currentSearch) {
      const keyword = normalizeText(currentSearch);
      filtered = filtered.filter((a) => normalizeText(a.title).includes(keyword) || normalizeText(a.author).includes(keyword) || normalizeText(a.topic).includes(keyword) || normalizeText(a.description).includes(keyword));
    }
    if (currentTopic !== "all") filtered = filtered.filter((a) => normalizeText(a.topic) === normalizeText(currentTopic));
    if (currentSort === "latest") filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
    else if (currentSort === "oldest") filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
    else if (currentSort === "title-az") filtered.sort((a, b) => a.title.localeCompare(b.title));
    else if (currentSort === "title-za") filtered.sort((a, b) => b.title.localeCompare(a.title));
    return filtered;
  }

  function renderArticles() {
    const filtered = getFilteredArticles();
    const totalPages = Math.ceil(filtered.length / ITEMS_PER_PAGE) || 1;
    if (currentPage > totalPages) currentPage = 1;
    const start = (currentPage - 1) * ITEMS_PER_PAGE;
    const currentItems = filtered.slice(start, start + ITEMS_PER_PAGE);
    articleGrid.innerHTML = "";
    if (filtered.length === 0) { emptyState.classList.remove("hidden"); paginationWrap.innerHTML = ""; return; }
    emptyState.classList.add("hidden");

    currentItems.forEach((article) => {
      const card = document.createElement("article");
      card.className = "article-card";
      card.innerHTML = `
        <div class="article-card-image"><img src="${article.image}" alt="${article.title}"></div>
        <div class="article-card-body">
          <div class="article-card-top">
            <span class="article-topic ${topicClass(article.topic)}">${article.topic}</span>
            <span class="article-date">${article.displayDate}</span>
          </div>
          <h3>${article.title}</h3>
          <p>${article.description}</p>
        </div>`;
      card.addEventListener("click", () => { window.location.href = "/detailArtikelUser?article=" + article.id; });
      articleGrid.appendChild(card);
    });

    renderPagination(totalPages);
    renderStats(filtered);
  }

  function renderPagination(totalPages) {
    paginationWrap.innerHTML = "";
    if (totalPages <= 1) return;
    const createButton = (label, page, isActive = false, extraClass = "") => {
      const btn = document.createElement("button");
      btn.className = `page-btn ${extraClass} ${isActive ? "active" : ""}`.trim();
      btn.innerHTML = label;
      btn.addEventListener("click", () => { currentPage = page; renderArticles(); });
      return btn;
    };
    if (currentPage > 1) paginationWrap.appendChild(createButton(`<svg viewBox="0 0 24 24" fill="none"><path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>`, currentPage - 1, false, "icon-btn"));
    const pagesToShow = [];
    for (let i = 1; i <= totalPages; i++) { if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) pagesToShow.push(i); }
    let lastPage = 0;
    pagesToShow.forEach((page) => {
      if (page - lastPage > 1) { const dots = document.createElement("span"); dots.className = "page-dots"; dots.textContent = "..."; paginationWrap.appendChild(dots); }
      paginationWrap.appendChild(createButton(page, page, page === currentPage));
      lastPage = page;
    });
    if (currentPage < totalPages) paginationWrap.appendChild(createButton(`<svg viewBox="0 0 24 24" fill="none"><path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>`, currentPage + 1, false, "icon-btn"));
  }

  function renderStats(filtered) {
    totalSavedStat.textContent = filtered.length;
    const categoryCount = {};
    filtered.forEach((a) => { categoryCount[a.topic] = (categoryCount[a.topic] || 0) + 1; });
    let maxCategory = "Hydroponics", maxCount = 0;
    Object.keys(categoryCount).forEach((topic) => { if (categoryCount[topic] > maxCount) { maxCount = categoryCount[topic]; maxCategory = topic; } });
    topCategoryStat.textContent = maxCategory;
  }

  if (filterToggle) filterToggle.addEventListener("click", () => filterPanel.classList.toggle("hidden"));
  articleSearch.addEventListener("input", (e) => { currentSearch = e.target.value; currentPage = 1; renderArticles(); });
  topicFilters.forEach((chip) => { chip.addEventListener("click", function () { topicFilters.forEach((i) => i.classList.remove("active")); this.classList.add("active"); currentTopic = this.getAttribute("data-topic"); currentPage = 1; renderArticles(); }); });
  sortSelect.addEventListener("change", (e) => { currentSort = e.target.value; currentPage = 1; renderArticles(); });
  resetFilters.addEventListener("click", () => { currentSearch = ""; currentTopic = "all"; currentSort = "latest"; currentPage = 1; articleSearch.value = ""; sortSelect.value = "latest"; topicFilters.forEach((i) => i.classList.remove("active")); document.querySelector('.filter-chip[data-topic="all"]').classList.add("active"); renderArticles(); });

  renderArticles();
});