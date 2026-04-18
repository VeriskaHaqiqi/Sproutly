/* ============================================================
   income-history.js  –  Sproutly Expert Income History
   ============================================================ */

document.addEventListener("DOMContentLoaded", () => {

  /* ── REFS ─────────────────────────────────────── */
  const sidebar        = document.getElementById("sidebar");
  const mainContent    = document.getElementById("mainContent");
  const sidebarToggle  = document.getElementById("sidebarToggle");
  const filterTabs     = document.querySelectorAll(".filter-tab");
  const txCards        = document.querySelectorAll(".tx-card");
  const emptyState     = document.getElementById("emptyState");

  /* ── SIDEBAR LOGIC (dari kode yang diberikan) ─── */

  sidebarToggle.addEventListener("click", function () {
    if (window.innerWidth <= 768) {
      // Mobile: toggle .show
      sidebar.classList.toggle("show");
    } else {
      // Desktop: toggle .closed & geser main content
      sidebar.classList.toggle("closed");
      mainContent.classList.toggle("full");
    }
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
      sidebar.classList.remove("show");
    } else {
      sidebar.classList.remove("closed");
      mainContent.classList.remove("full");
    }
  });

  // Klik di luar sidebar (mobile) → tutup
  document.addEventListener("click", function (e) {
    if (window.innerWidth > 768) return;
    const clickedInSidebar = sidebar.contains(e.target);
    const clickedToggle    = sidebarToggle.contains(e.target);
    if (!clickedInSidebar && !clickedToggle) {
      sidebar.classList.remove("show");
    }
  });

  /* ── FILTER TABS ─────────────────────────────── */
  const summaryData = {
    "all": {
      total:    "$2,847",
      month:    "$485",
      sessions: "23 sessions",
    },
    "this-month": {
      total:    "$325",
      month:    "$325",
      sessions: "5 sessions",
    },
    "last-month": {
      total:    "$250",
      month:    "$250",
      sessions: "3 sessions",
    },
  };

  let activeFilter = "all";

  function applyFilter() {
    let visible = 0;

    txCards.forEach(card => {
      const period = card.dataset.period;
      const show   = activeFilter === "all" || period === activeFilter;
      card.style.display = show ? "flex" : "none";
      if (show) visible++;
    });

    emptyState.classList.toggle("hidden", visible > 0);
    updateSummary();
  }

  function updateSummary() {
    const data = summaryData[activeFilter];
    if (!data) return;

    animateText(document.getElementById("totalIncome"),  data.total);
    animateText(document.getElementById("monthIncome"),  data.month);
    animateText(document.getElementById("sessionCount"), data.sessions);
  }

  function animateText(el, newVal) {
    if (!el) return;
    el.style.opacity   = "0";
    el.style.transform = "translateY(6px)";
    setTimeout(() => {
      el.textContent     = newVal;
      el.style.transition = "opacity .25s ease, transform .25s ease";
      el.style.opacity   = "1";
      el.style.transform = "translateY(0)";
    }, 130);
  }

  filterTabs.forEach(tab => {
    tab.addEventListener("click", () => {
      filterTabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");
      activeFilter = tab.dataset.filter;
      applyFilter();
    });
  });

  /* ── BAR CHART ANIMATION ─────────────────────── */
  function animateBars() {
    document.querySelectorAll(".bar-fill").forEach((bar, i) => {
      const target = bar.style.height;
      bar.style.height     = "0%";
      bar.style.transition = "none";
      setTimeout(() => {
        bar.style.transition = "height .65s cubic-bezier(.34,1.56,.64,1)";
        bar.style.height     = target;
      }, 160 + i * 80);
    });
  }

  /* ── INIT ────────────────────────────────────── */
  applyFilter();
  animateBars();
});