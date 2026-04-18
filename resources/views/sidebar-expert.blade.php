{{-- ============================================================
   sidebar-expert.blade.php – Sproutly Expert Sidebar (All-in-one)
   Cara pakai:
       @php $activePage = 'dashboard' @endphp
       @include('sidebar-expert')

   Nilai $activePage:
       'dashboard' | 'consultation' | 'article' |
       'my-article' | 'pricing' | 'client-history' | 'settings'
   ============================================================ --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

:root {
  --mint      : #76ead0;
  --sky       : #76d7ea;
  --sidebar-w : 260px;
  --green-mid : #169857;
  --green-dark: #118f54;
  --text-mid  : #5e6d84;
}

.sidebar {
  position: fixed;
  top: 0; left: 0;
  width: var(--sidebar-w);
  height: 100vh;
  background: linear-gradient(180deg, #d9f1eb 0%, #d7efe9 100%);
  border-right: 1px solid #c5e2db;
  padding: 22px 16px;
  overflow-y: auto;
  transition: left 0.35s ease;
  z-index: 1000;
  scrollbar-width: none;
  font-family: 'Inter', sans-serif;
}
.sidebar::-webkit-scrollbar { display: none; }
.sidebar.closed { left: calc(-1 * var(--sidebar-w)); }
.sidebar.show   { left: 0; }

@media (max-width: 768px) {
  .sidebar { left: calc(-1 * var(--sidebar-w)); }
  .sidebar.show { left: 0; }
}

.sidebar-header {
  display: flex; align-items: center;
  min-height: 56px; margin-bottom: 4px;
}

.logo-wrap {
  display: flex; align-items: center;
  gap: 14px; text-decoration: none;
}

.logo-box {
  width: 42px; height: 42px; border-radius: 12px;
  background: linear-gradient(135deg, var(--mint), var(--sky));
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.logo-img {
  width: 24px; height: 24px;
  object-fit: contain;
  filter: brightness(0) invert(1);
}

.logo-text {
  font-size: 20px; font-weight: 800;
  color: var(--green-mid);
  letter-spacing: -0.02em;
}

.sidebar-line {
  height: 1px; background: #bedfd7;
  margin: 14px -16px 18px;
}

.sidebar-menu { display: flex; flex-direction: column; gap: 6px; }

.menu-link {
  display: flex; align-items: center; gap: 14px;
  padding: 13px 18px; border-radius: 18px;
  color: var(--text-mid); font-size: 15px; font-weight: 500;
  text-decoration: none;
  transition: background 0.22s ease, color 0.22s ease;
}

.menu-link i {
  font-size: 17px; width: 20px; text-align: center;
  flex-shrink: 0; color: #7a9189;
  transition: color 0.22s ease;
}

.menu-link:hover { background: rgba(255,255,255,0.55); }
.menu-link:hover i { color: var(--green-dark); }

.menu-link.active {
  background: #ffffff; color: var(--green-dark);
  font-weight: 700; box-shadow: 0 8px 18px rgba(0,0,0,0.06);
}
.menu-link.active i { color: var(--green-dark); }

.main-content {
  margin-left: 0; min-height: 100vh;
  display: flex; flex-direction: column;
  transition: margin-left 0.35s ease;
}
.main-content.full    { margin-left: 0; }
.main-content.shifted { margin-left: var(--sidebar-w); }

@media (max-width: 768px) {
  .main-content,
  .main-content.shifted { margin-left: 0; }
}
</style>

<aside class="sidebar closed" id="sidebar">
  <div class="sidebar-header">
    <a href="{{ url('/homeExpert') }}" class="logo-wrap">
      <div class="logo-box">
        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
      </div>
      <span class="logo-text">Sproutly</span>
    </a>
  </div>

  <div class="sidebar-line"></div>

  <nav class="sidebar-menu">
    <a href="{{ url('/dashboard-ahli') }}" class="menu-link {{ ($activePage ?? '') === 'dashboard' ? 'active' : '' }}">
      <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
    </a>
    <a href="{{ url('/consulexpert') }}" class="menu-link {{ ($activePage ?? '') === 'consultation' ? 'active' : '' }}">
      <i class="fa-solid fa-comments"></i><span>Consultation</span>
    </a>
    <a href="{{ url('/articleExpert') }}" class="menu-link {{ ($activePage ?? '') === 'article' ? 'active' : '' }}">
      <i class="fa-solid fa-newspaper"></i><span>Article</span>
    </a>
    <a href="{{ url('/myarticleExpert') }}" class="menu-link {{ ($activePage ?? '') === 'my-article' ? 'active' : '' }}">
      <i class="fa-solid fa-file-pen"></i><span>My Article</span>
    </a>
    <a href="{{ url('/setpricingexpert') }}" class="menu-link {{ ($activePage ?? '') === 'pricing' ? 'active' : '' }}">
      <i class="fa-solid fa-tag"></i><span>Pricing</span>
    </a>
    <a href="{{ url('/ConsultationhistoryUser') }}" class="menu-link {{ ($activePage ?? '') === 'client-history' ? 'active' : '' }}">
      <i class="fa-solid fa-clock-rotate-left"></i><span>Client History</span>
    </a>
    <a href="{{ url('/accountExpert') }}" class="menu-link {{ ($activePage ?? '') === 'settings' ? 'active' : '' }}">
      <i class="fa-solid fa-gear"></i><span>Setting</span>
    </a>
  </nav>
</aside>

<script>
(function () {
  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");
  const sidebarToggle = document.getElementById("sidebarToggle") || document.getElementById("menuToggle");

  if (!sidebar || !mainContent || !sidebarToggle) return;

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

  document.querySelectorAll(".menu-link").forEach((link) => {
    link.addEventListener("click", () => closeSidebar());
  });

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
})();
</script>