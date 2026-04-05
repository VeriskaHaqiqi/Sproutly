{{-- resources/views/expert/homeExpert.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sproutly — Dashboard Expert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-homeExpert.css') }}">
</head>
<body>

<!-- ===================== LAYOUT WRAPPER ===================== -->
<div class="app-wrapper" id="appWrapper">

    <!-- ===================== SIDEBAR ===================== -->
    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-top">
            <div class="brand-wrap">
                <div class="brand-logo-box">
                    <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                </div>
                <span class="brand-text">Sproutly</span>
            </div>
        </div>

        <div class="sidebar-divider"></div>

        <nav class="sidebar-menu" id="sidebarMenu">
            <button class="menu-item active" data-menu="Dashboard" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                </span>
                <span class="menu-label">Dashboard</span>
            </button>

            <button class="menu-item" data-menu="Consultation" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                </span>
                <span class="menu-label">Consultation</span>
            </button>

            <button class="menu-item" data-menu="Article" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/article.png') }}" alt="Article">
                </span>
                <span class="menu-label">Article</span>
            </button>

            <button class="menu-item" data-menu="My Article" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                </span>
                <span class="menu-label">My Article</span>
            </button>

            <button class="menu-item" data-menu="Pricing" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                </span>
                <span class="menu-label">Pricing</span>
            </button>

            <button class="menu-item" data-menu="Client History" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                </span>
                <span class="menu-label">Client History</span>
            </button>

            <button class="menu-item" data-menu="Setting" type="button">
                <span class="menu-icon">
                    <img src="{{ asset('images/settings.png') }}" alt="Setting">
                </span>
                <span class="menu-label">Setting</span>
            </button>
        </nav>
    </aside>

    <!-- ===================== MAIN AREA ===================== -->
    <div class="main-area" id="mainArea">

        <!-- ===== TOPBAR ===== -->
        <header class="topbar">
            <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <div class="topbar-brand">
                <img src="{{ asset('images/logo-hijau.png') }}" alt="Sproutly" class="topbar-logo">
                <span class="topbar-name">Sproutly</span>
            </div>
            <div class="topbar-right">
                <div class="topbar-avatar">S</div>
            </div>
        </header>

        <!-- ===== PAGE CONTENT ===== -->
        <main class="page-content">

            <!-- Hero Greeting -->
            <section class="hero-card">
                <div class="hero-text">
                    <h1 class="hero-title">Halo, Dr. Sarah!</h1>
                    <p class="hero-subtitle">Siap membantu petani Indonesia mencapai hasil panen terbaik hari ini?</p>
                </div>
            </section>

            <!-- Action Cards -->
            <section class="action-grid">

                <!-- Tulis Artikel -->
                <div class="action-card card-article">
                    <div class="card-icon-wrap icon-article">
                        <img src="{{ asset('images/tulisartikel.png') }}" alt="Tulis Artikel">
                    </div>
                    <h2 class="card-title">Tulis Artikel</h2>
                    <p class="card-desc">Bagikan pengetahuan dan tips pertanian terbaru untuk membantu petani Indonesia</p>
                    <a href="/tulisartikelExpert" class="card-btn btn-article">Mulai Menulis</a>
                </div>

                <!-- Atur Jadwal -->
                <div class="action-card card-schedule">
                    <div class="card-icon-wrap icon-schedule">
                        <img src="{{ asset('images/aturjadwal.png') }}" alt="Atur Jadwal">
                    </div>
                    <h2 class="card-title">Atur Jadwal</h2>
                    <p class="card-desc">Kelola jadwal konsultasi dan sesi bimbingan dengan petani yang membutuhkan</p>
                    <a href="{{ route('manageSchedule') }}" class="card-btn btn-schedule">Lihat Jadwal</a>
                </div>

            </section>

        </main>

        <!-- ===== FOOTER ===== -->
        <footer class="site-footer">
            <div class="footer-inner">
                <div class="footer-brand-col">
                    <div class="footer-brand-row">
                        <div class="footer-logo-box">
                            <img src="{{ asset('images/logo.png') }}" alt="Sproutly">
                        </div>
                        <span class="footer-brand-name">Sproutly by AVI</span>
                    </div>
                    <p class="footer-tagline">Platform konsultasi pertanian terdepan yang menghubungkan petani dengan ahli pertanian berpengalaman.</p>
                </div>
                <div class="footer-links-col">
                    <h4 class="footer-col-title">Layanan</h4>
                    <ul class="footer-list">
                        <li><a href="#">Konsultasi Online</a></li>
                        <li><a href="#">Artikel Pertanian</a></li>
                        <li><a href="#">Forum Diskusi</a></li>
                        <li><a href="#">Pelatihan</a></li>
                    </ul>
                </div>
                <div class="footer-contact-col">
                    <h4 class="footer-col-title">Kontak</h4>
                    <ul class="footer-list">
                        <li>• Email: info@sproutly.id</li>
                        <li>• Telepon: +62 21 1234 5678</li>
                        <li>• Alamat: Surabaya Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Sproutly by AVI. Semua hak dilindungi.</p>
            </div>
        </footer>

    </div><!-- /.main-area -->
</div><!-- /.app-wrapper -->

<!-- Mobile overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="{{ asset('js/script-homeExpert.js') }}"></script>
</body>
</html>