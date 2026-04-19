const sidebar = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");
const sidebarToggle = document.getElementById("sidebarToggle");

const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const statusFilter = document.getElementById("statusFilter");
const startDateInput = document.getElementById("startDate");
const endDateInput = document.getElementById("endDate");
const resetFilterBtn = document.getElementById("resetFilterBtn");

const articleGrid = document.getElementById("articleGrid");
const articleCards = Array.from(document.querySelectorAll(".article-card"));
const pagination = document.getElementById("pagination");
const resultsCount = document.getElementById("resultsCount");
const emptyState = document.getElementById("emptyState");

const ITEMS_PER_PAGE = 6;
let currentPage = 1;
let filteredArticles = [...articleCards];

/* SIDEBAR */
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
    if (window.innerWidth <= 768) {
        sidebar.classList.remove("show");
    } else {
        sidebar.classList.add("closed");
        mainContent.classList.remove("shifted");
        mainContent.classList.add("full");
    }
}

function isSidebarOpen() {
    if (window.innerWidth <= 768) {
        return sidebar.classList.contains("show");
    }
    return !sidebar.classList.contains("closed");
}

sidebarToggle.addEventListener("click", function () {
    if (isSidebarOpen()) {
        closeSidebar();
    } else {
        openSidebar();
    }
});

window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
        sidebar.classList.remove("show");
        sidebar.classList.remove("closed");
        mainContent.classList.add("shifted");
        mainContent.classList.remove("full");
    } else {
        sidebar.classList.remove("closed");
        mainContent.classList.remove("shifted");
        mainContent.classList.add("full");
    }
});

/* FILTER */
function normalizeText(text) {
    return String(text || "").trim().toLowerCase();
}

function parseDate(dateString) {
    return new Date(dateString + "T00:00:00");
}

function matchesSearch(card, searchValue) {
    const title = normalizeText(card.dataset.title);
    return title.includes(normalizeText(searchValue));
}

function matchesCategory(card, categoryValue) {
    if (categoryValue === "all") return true;
    return normalizeText(card.dataset.category) === normalizeText(categoryValue);
}

function matchesStatus(card, statusValue) {
    if (statusValue === "all") return true;
    return normalizeText(card.dataset.status) === normalizeText(statusValue);
}

function matchesDateRange(card, startDate, endDate) {
    const articleDate = parseDate(card.dataset.date);

    if (startDate) {
        const start = parseDate(startDate);
        if (articleDate < start) return false;
    }

    if (endDate) {
        const end = parseDate(endDate);
        if (articleDate > end) return false;
    }

    return true;
}

function applyFilters() {
    const searchValue = searchInput.value;
    const categoryValue = categoryFilter.value;
    const statusValue = statusFilter.value;
    const startDate = startDateInput.value;
    const endDate = endDateInput.value;

    filteredArticles = articleCards.filter((card) => {
        return (
            matchesSearch(card, searchValue) &&
            matchesCategory(card, categoryValue) &&
            matchesStatus(card, statusValue) &&
            matchesDateRange(card, startDate, endDate)
        );
    });

    currentPage = 1;
    renderArticles();
    renderPagination();
    updateResultText();
}

function renderArticles() {
    articleCards.forEach((card) => {
        card.style.display = "none";
    });

    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;
    const currentItems = filteredArticles.slice(startIndex, endIndex);

    currentItems.forEach((card) => {
        card.style.display = "block";
    });

    if (filteredArticles.length === 0) {
        articleGrid.style.display = "none";
        emptyState.classList.add("show");
    } else {
        articleGrid.style.display = "grid";
        emptyState.classList.remove("show");
    }
}

function renderPagination() {
    pagination.innerHTML = "";

    const totalPages = Math.ceil(filteredArticles.length / ITEMS_PER_PAGE);

    if (totalPages <= 1) return;

    const prevBtn = document.createElement("button");
    prevBtn.className = "page-btn";
    prevBtn.innerHTML = '<i class="fa-solid fa-angle-left"></i>';
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            renderArticles();
            renderPagination();
            updateResultText();
        }
    });
    pagination.appendChild(prevBtn);

    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement("button");
        pageBtn.className = "page-btn" + (i === currentPage ? " active" : "");
        pageBtn.textContent = i;
        pageBtn.addEventListener("click", function () {
            currentPage = i;
            renderArticles();
            renderPagination();
            updateResultText();
        });
        pagination.appendChild(pageBtn);
    }

    const nextBtn = document.createElement("button");
    nextBtn.className = "page-btn";
    nextBtn.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener("click", function () {
        if (currentPage < totalPages) {
            currentPage++;
            renderArticles();
            renderPagination();
            updateResultText();
        }
    });
    pagination.appendChild(nextBtn);
}

function updateResultText() {
    const total = filteredArticles.length;

    if (total === 0) {
        resultsCount.textContent = "Showing 0 articles";
        return;
    }

    const start = (currentPage - 1) * ITEMS_PER_PAGE + 1;
    const end = Math.min(currentPage * ITEMS_PER_PAGE, total);

    resultsCount.textContent = `Showing ${start} to ${end} of ${total} articles`;
}

function resetFilters() {
    searchInput.value = "";
    categoryFilter.value = "all";
    statusFilter.value = "all";
    startDateInput.value = "";
    endDateInput.value = "";
    applyFilters();
}

searchInput.addEventListener("input", applyFilters);
categoryFilter.addEventListener("change", applyFilters);
statusFilter.addEventListener("change", applyFilters);
startDateInput.addEventListener("change", applyFilters);
endDateInput.addEventListener("change", applyFilters);
resetFilterBtn.addEventListener("click", resetFilters);

function initializeLayout() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove("closed");
        mainContent.classList.add("shifted");
        mainContent.classList.remove("full");
    } else {
        sidebar.classList.remove("closed");
        mainContent.classList.remove("shifted");
        mainContent.classList.add("full");
    }
}

initializeLayout();
applyFilters();