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

  const articles = [
    { id: "hydroponic-systems", title: "Advanced Hydroponic Systems for Urban Farming", topic: "Hydroponics", date: "2024-12-15", displayDate: "Dec 15, 2024", author: "Alicia Warren", description: "Explore cutting-edge hydroponic technologies that maximize yield in minimal space, perfect for urban agricultural initiatives.", image: "https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=1000&q=80", lead: "Hydroponic farming is reshaping urban agriculture by enabling high-yield cultivation in compact environments.", quote: "Hydroponics proves that efficient farming is not limited by land — only by imagination and design.", quoteAuthor: "- Alicia Warren, Urban Farming Specialist" },
    { id: "soil-management", title: "Sustainable Soil Management Techniques", topic: "Soil Health", date: "2024-12-12", displayDate: "Dec 12, 2024", author: "Robert Martinez", description: "Learn proven methods to enhance soil fertility while maintaining ecological balance for long-term agricultural success.", image: "https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?w=1000&q=80", lead: "Healthy soil is one of the strongest foundations of productive and sustainable agriculture.", quote: "When farmers care for soil life, the soil returns that care through stronger and healthier crops.", quoteAuthor: "- Robert Martinez, Soil Specialist" },
    { id: "iot-modern-agriculture", title: "IoT Integration in Modern Agriculture", topic: "Smart Farming", date: "2024-12-10", displayDate: "Dec 10, 2024", author: "David Rodriguez", description: "Discover how Internet of Things technology revolutionizes crop monitoring and precision farming practices.", image: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1000&q=80", lead: "Smart farming systems allow growers to monitor crops in real time and make more accurate operational decisions.", quote: "Connected agriculture transforms guesswork into measurable action.", quoteAuthor: "- David Rodriguez, AgriTech Analyst" },
    { id: "organic-pest-management", title: "Organic Pest Management Solutions", topic: "Pest Control", date: "2024-12-08", displayDate: "Dec 8, 2024", author: "Emma Thompson", description: "Natural and effective strategies to protect crops from pests while maintaining organic certification standards.", image: "https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=1000&q=80", lead: "Organic pest control helps farms reduce chemical dependency while protecting crop productivity.", quote: "The healthiest farms are often the ones that work with ecosystems instead of against them.", quoteAuthor: "- Emma Thompson, Crop Specialist" },
    { id: "climate-smart-practices", title: "Climate-Smart Agriculture Practices", topic: "Climate", date: "2024-12-05", displayDate: "Dec 5, 2024", author: "James Wilson", description: "Adaptive farming techniques that help crops thrive despite changing climate conditions and weather patterns.", image: "https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=1000&q=80", lead: "Climate-smart farming helps growers stay resilient amid rainfall shifts, heat stress, and uncertain seasonal cycles.", quote: "Agricultural resilience comes from planning for change, not resisting it.", quoteAuthor: "- James Wilson, Climate Agriculture Analyst" },
    { id: "vertical-farming-revolution", title: "Vertical Farming Revolution", topic: "Vertical Farming", date: "2024-12-03", displayDate: "Dec 3, 2024", author: "Lisa Anderson", description: "Maximize production efficiency with innovative vertical growing systems designed for space-constrained environments.", image: "https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=1000&q=80", lead: "Vertical farming enables efficient crop production in controlled indoor environments with limited land use.", quote: "Vertical farming is not just about stacking crops, but stacking efficiency, precision, and sustainability.", quoteAuthor: "- Lisa Anderson, Controlled Environment Agriculture Researcher" },
    { id: "smart-irrigation", title: "Smart Irrigation: Maximizing Water Efficiency", topic: "Smart Farming", date: "2024-11-30", displayDate: "Nov 30, 2024", author: "James Wilson", description: "Learn how smart irrigation systems can reduce water usage while improving crop yields and field consistency.", image: "https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=1000&q=80", lead: "Efficient irrigation systems are crucial for modern farming and water conservation.", quote: "The future of farming depends on how wisely we use every drop of water.", quoteAuthor: "- James Wilson, Irrigation Analyst" },
    { id: "crop-rotation", title: "Crop Rotation Strategies for Soil Health", topic: "Soil Health", date: "2024-11-27", displayDate: "Nov 27, 2024", author: "Maria Garcia", description: "Master the art of crop rotation to improve soil fertility, reduce pest pressure, and support long-term productivity.", image: "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=1000&q=80", lead: "Crop rotation remains one of the most practical methods for maintaining soil productivity and ecosystem balance.", quote: "Healthy soil is built through thoughtful cycles and long-term care.", quoteAuthor: "- Maria Garcia, Soil Researcher" },
    { id: "greenhouse-efficiency", title: "Greenhouse Efficiency and Controlled Cultivation", topic: "Hydroponics", date: "2024-11-22", displayDate: "Nov 22, 2024", author: "Sarah Chen", description: "Improve greenhouse productivity with better environmental control, monitoring systems, and layout optimization.", image: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=1000&q=80", lead: "Controlled cultivation systems help growers optimize consistency, crop quality, and year-round output.", quote: "A productive greenhouse is built on precision, balance, and control.", quoteAuthor: "- Sarah Chen, Greenhouse Systems Expert" }
  ];

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
      card.addEventListener("click", () => { window.location.href = "/detailArtikelUser"; });
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