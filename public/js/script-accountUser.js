/* =====================
   SIDEBAR TOGGLE
===================== */
(function () {
  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");
  const overlay       = document.getElementById("sidebarOverlay");
  const sidebarToggle = document.getElementById("sidebarToggle");

  if (!sidebar || !sidebarToggle) return;

  const MOBILE_BP = 768;

  function isMobile() {
    return window.innerWidth <= MOBILE_BP;
  }

  function openSidebar() {
    sidebar.classList.remove("closed");
    sidebarToggle.classList.add("is-open");

    if (isMobile()) {
      // Mobile: pakai overlay, tidak push layout
      if (overlay) {
        overlay.style.display = "block";
        requestAnimationFrame(() => overlay.classList.add("active"));
      }
    } else {
      // Desktop: push layout ke kanan
      if (mainContent) mainContent.classList.add("pushed");
    }

    document.body.classList.add("sidebar-open");
  }

  function closeSidebar() {
    sidebar.classList.add("closed");
    sidebarToggle.classList.remove("is-open");

    // Tutup overlay (mobile)
    if (overlay) {
      overlay.classList.remove("active");
      setTimeout(() => { overlay.style.display = "none"; }, 260);
    }

    // Kembalikan layout (desktop)
    if (mainContent) mainContent.classList.remove("pushed");

    document.body.classList.remove("sidebar-open");
  }

  function isSidebarOpen() {
    return !sidebar.classList.contains("closed");
  }

  // ── Init: sidebar tertutup saat halaman dibuka ──
  sidebar.classList.add("closed");
  if (overlay) overlay.style.display = "none";

  // ── Burger toggle ──
  sidebarToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    isSidebarOpen() ? closeSidebar() : openSidebar();
  });

  // ── Klik overlay (mobile) → tutup ──
  if (overlay) {
    overlay.addEventListener("click", () => closeSidebar());
  }

  // ── Klik di luar sidebar (desktop) → tutup ──
  document.addEventListener("click", (e) => {
    if (
      !isMobile() &&
      isSidebarOpen() &&
      !sidebar.contains(e.target) &&
      !sidebarToggle.contains(e.target)
    ) {
      closeSidebar();
    }
  });

  // ── Klik link di sidebar → tutup (UX) ──
  document.querySelectorAll(".sidebar-menu .menu-link").forEach((link) => {
    link.addEventListener("click", () => closeSidebar());
  });

  // ── Resize: sesuaikan behaviour ──
  window.addEventListener("resize", () => {
    if (isSidebarOpen()) {
      if (isMobile()) {
        if (mainContent) mainContent.classList.remove("pushed");
        if (overlay) {
          overlay.style.display = "block";
          requestAnimationFrame(() => overlay.classList.add("active"));
        }
      } else {
        if (overlay) {
          overlay.classList.remove("active");
          setTimeout(() => { overlay.style.display = "none"; }, 260);
        }
        if (mainContent) mainContent.classList.add("pushed");
      }
    }
  });
})();

/* =====================
   SCROLL REVEAL (account cards)
===================== */
const cards = document.querySelectorAll('.account-card');

const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      entry.target.style.animationDelay = `${i * 0.06}s`;
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.08 });

cards.forEach(card => observer.observe(card));