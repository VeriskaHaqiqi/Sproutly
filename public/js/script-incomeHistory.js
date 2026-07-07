document.addEventListener("DOMContentLoaded", () => {

  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const filterTabs    = document.querySelectorAll(".filter-tab");
  const txCards       = document.querySelectorAll(".tx-card");
  const emptyState    = document.getElementById("emptyStateFilter");

  // ── Sidebar ──────────────────────────────────────
  function openSidebar() {
    if (window.innerWidth <= 768) {
      sidebar.classList.add("show"); sidebar.classList.remove("closed");
    } else {
      sidebar.classList.remove("closed");
      mainContent.classList.add("shifted"); mainContent.classList.remove("full");
    }
  }
  function closeSidebar() {
    sidebar.classList.add("closed"); sidebar.classList.remove("show");
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
  }
  function isSidebarOpen() {
    return window.innerWidth <= 768
      ? sidebar.classList.contains("show")
      : !sidebar.classList.contains("closed");
  }

  sidebarToggle.addEventListener("click", () => isSidebarOpen() ? closeSidebar() : openSidebar());

  document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768 && isSidebarOpen() &&
        !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
      closeSidebar();
    }
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) sidebar.classList.remove("show");
    else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
  });

  // ── Filter Tabs ───────────────────────────────────
  let activeFilter = "all";

  function applyFilter() {
    let visible = 0;
    txCards.forEach(card => {
      const show = activeFilter === "all" || card.dataset.period === activeFilter;
      card.style.display = show ? "flex" : "none";
      if (show) visible++;
    });
    // Tampilkan empty state jika tidak ada yang tampil
    if (visible === 0) {
      emptyState.classList.remove("hidden");
    } else {
      emptyState.classList.add("hidden");
    }
  }

  filterTabs.forEach(tab => {
    tab.addEventListener("click", () => {
      filterTabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");
      activeFilter = tab.dataset.filter;
      applyFilter();
    });
  });

  // ── Bar Chart Animation ───────────────────────────
  document.querySelectorAll(".bar-fill").forEach((bar, i) => {
    const target = bar.style.height || "0%";
    bar.dataset.targetHeight = target;
    bar.style.transition = "none";
    bar.style.height = "0%";
    requestAnimationFrame(() => requestAnimationFrame(() => {
      setTimeout(() => {
        bar.style.transition = "height .65s cubic-bezier(.34,1.56,.64,1)";
        bar.style.height = target;
      }, i * 90);
    }));
  });

  // ── Init ──────────────────────────────────────────
  applyFilter();
});