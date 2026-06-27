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

  // ── BOOKMARK DATA DARI DATABASE ──────────────────
  const bookmarkedArticles = window.BOOKMARKED_ARTICLES || [];
  const bookmarkStats = window.BOOKMARK_STATS || { total: 0, this_week: 0, top_category: 'No Articles' };

  // ── DOM Elements ──────────────────────────────────
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

  // ── Data ──────────────────────────────────────────
  const articles = bookmarkedArticles;

  // ── Helper Functions ──────────────────────────────
  function topicClass(topic) { 
    return `topic-${topic.toLowerCase().replace(/\s+/g, "-")}`; 
  }
  
  function normalizeText(text) { 
    return text.toLowerCase().trim(); 
  }

  // ── Get Filtered Articles ────────────────────────
  function getFilteredArticles() {
    let filtered = [...articles];
    
    if (currentSearch) {
      const keyword = normalizeText(currentSearch);
      filtered = filtered.filter((a) => 
        normalizeText(a.title).includes(keyword) || 
        normalizeText(a.author).includes(keyword) || 
        normalizeText(a.topic).includes(keyword) || 
        normalizeText(a.description).includes(keyword)
      );
    }
    
    if (currentTopic !== "all") {
      filtered = filtered.filter((a) => 
        normalizeText(a.topic) === normalizeText(currentTopic)
      );
    }
    
    if (currentSort === "latest") {
      filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
    } else if (currentSort === "oldest") {
      filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
    } else if (currentSort === "title-az") {
      filtered.sort((a, b) => a.title.localeCompare(b.title));
    } else if (currentSort === "title-za") {
      filtered.sort((a, b) => b.title.localeCompare(a.title));
    }
    
    return filtered;
  }

  // ── Render Articles ──────────────────────────────
  function renderArticles() {
    const filtered = getFilteredArticles();
    const totalPages = Math.ceil(filtered.length / ITEMS_PER_PAGE) || 1;
    if (currentPage > totalPages) currentPage = 1;
    const start = (currentPage - 1) * ITEMS_PER_PAGE;
    const currentItems = filtered.slice(start, start + ITEMS_PER_PAGE);
    
    articleGrid.innerHTML = "";
    
    if (filtered.length === 0) { 
      emptyState.classList.remove("hidden"); 
      paginationWrap.innerHTML = ""; 
      return; 
    }
    
    emptyState.classList.add("hidden");

    currentItems.forEach((article) => {
      const card = document.createElement("article");
      card.className = "article-card";
      
      const imageHtml = article.image 
        ? `<img src="${article.image}" alt="${article.title}" onerror="this.style.display='none'">`
        : `<div style="background:linear-gradient(135deg,#76ead0,#76d7ea);height:100%;display:flex;align-items:center;justify-content:center;color:#155a4a;font-weight:600;font-size:14px;">No Image</div>`;
      
      card.innerHTML = `
        <div class="article-card-image">${imageHtml}</div>
        <div class="article-card-body">
          <div class="article-card-top">
            <span class="article-topic ${topicClass(article.topic)}">${article.topic}</span>
            <span class="article-date">${article.displayDate}</span>
          </div>
          <h3>${article.title}</h3>
          <p>${article.description}</p>
          <div class="article-card-footer">
            <span class="article-author"><i class="fa-regular fa-user"></i> ${article.author}</span>
          </div>
        </div>`;
      
      card.addEventListener("click", () => { 
        window.location.href = "/detailArtikelUser?article=" + article.id; 
      });
      articleGrid.appendChild(card);
    });

    renderPagination(totalPages);
  }

  // ── Render Pagination ─────────────────────────────
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
    
    if (currentPage > 1) {
      paginationWrap.appendChild(createButton(`‹`, currentPage - 1, false, "icon-btn"));
    }
    
    const pagesToShow = [];
    for (let i = 1; i <= totalPages; i++) { 
      if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
        pagesToShow.push(i);
      }
    }
    
    let lastPage = 0;
    pagesToShow.forEach((page) => {
      if (page - lastPage > 1) { 
        const dots = document.createElement("span"); 
        dots.className = "page-dots"; 
        dots.textContent = "..."; 
        paginationWrap.appendChild(dots); 
      }
      paginationWrap.appendChild(createButton(page, page, page === currentPage));
      lastPage = page;
    });
    
    if (currentPage < totalPages) {
      paginationWrap.appendChild(createButton(`›`, currentPage + 1, false, "icon-btn"));
    }
  }

  // ── Update Stats ──────────────────────────────────
  function updateStats() {
    if (totalSavedStat) {
      totalSavedStat.textContent = bookmarkStats.total || articles.length;
    }
    if (topCategoryStat) {
      topCategoryStat.textContent = bookmarkStats.top_category || 'No Articles';
    }
  }

  // ── Event Listeners ──────────────────────────────
  if (filterToggle) {
    filterToggle.addEventListener("click", () => filterPanel.classList.toggle("hidden"));
  }
  
  if (articleSearch) {
    articleSearch.addEventListener("input", (e) => { 
      currentSearch = e.target.value; 
      currentPage = 1; 
      renderArticles(); 
    });
  }
  
  topicFilters.forEach((chip) => {
    chip.addEventListener("click", function () { 
      topicFilters.forEach((i) => i.classList.remove("active")); 
      this.classList.add("active"); 
      currentTopic = this.getAttribute("data-topic"); 
      currentPage = 1; 
      renderArticles(); 
    });
  });
  
  if (sortSelect) {
    sortSelect.addEventListener("change", (e) => { 
      currentSort = e.target.value; 
      currentPage = 1; 
      renderArticles(); 
    });
  }
  
  if (resetFilters) {
    resetFilters.addEventListener("click", () => { 
      currentSearch = ""; 
      currentTopic = "all"; 
      currentSort = "latest"; 
      currentPage = 1; 
      if (articleSearch) articleSearch.value = ""; 
      if (sortSelect) sortSelect.value = "latest"; 
      topicFilters.forEach((i) => i.classList.remove("active")); 
      document.querySelector('.filter-chip[data-topic="all"]')?.classList.add("active"); 
      renderArticles(); 
    });
  }

  // ── INIT ──────────────────────────────────────────
  updateStats();
  renderArticles();
  console.log('✅ Bookmarked Articles loaded!', articles.length, 'articles');
});