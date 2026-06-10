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

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('homeExpert') }}" class="logo-wrap">
                <div class="logo-box">
                    <img src="images/logo.png" class="logo-img">
                </div>
                <span class="logo-text">Sproutly</span>
            </a>
        </div>

        <div class="sidebar-line"></div>

        <nav class="sidebar-menu">
            <a href="{{ route('dashboard-ahli') }}"
            class="menu-link {{ request()->routeIs('dashboard-ahli') ? 'active' : '' }}">
                <img src="images/dashboard.png">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('consultexpert') }}"
            class="menu-link {{ request()->routeIs('consultexpert') ? 'active' : '' }}">
                <img src="images/consultation.png">
                <span>Consultation</span>
            </a>

            <a href="{{ route('articleExpert') }}"
            class="menu-link {{ request()->routeIs('articleExpert') ? 'active' : '' }}">
                <img src="images/article.png">
                <span>Article</span>
            </a>

            <a href="{{ route('myarticleExpert') }}"
            class="menu-link child-link {{ request()->routeIs('myarticleExpert') ? 'active' : '' }}">
                <img src="images/myarticle.png">
                <span>My Article</span>
            </a>

            <a href="{{ route('setpricingexpert') }}"
            class="menu-link child-link {{ request()->routeIs('setpricingexpert') ? 'active' : '' }}">
                <img src="images/pricing.png">
                <span>Pricing</span>
            </a>

            <a href="{{ route('ConsultationhistoryExpert') }}"
            class="menu-link child-link {{ request()->routeIs('ConsultationhistoryExpert') ? 'active' : '' }}">
                <img src="images/clienthistory.png">
                <span>Client History</span>
            </a>

            <a href="{{ route('accountExpert') }}"
            class="menu-link child-link {{ request()->routeIs('accountExpert') ? 'active' : '' }}">
                <img src="images/settings.png">
                <span>Setting</span>
            </a>
        </nav>
    </aside>

    <!-- ===================== MAIN AREA ===================== -->
    <div class="main-area" id="mainArea">

        <!-- ===== TOPBAR ===== -->
        <header class="topnav">
            <button class="burger-btn" id="sidebarToggle" aria-label="Toggle sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </header>

        <!-- ===== PAGE CONTENT ===== -->
        <main class="page-content">

            <!-- Hero Greeting -->
            <section class="hero-card">
                <div class="hero-text">
                    <h1 class="hero-title">Hallo, Dr. Sarah!</h1>
                    <p class="hero-subtitle">Ready to help Indonesian farmers achieve their best harvest today?</p>
                </div>
            </section>

            <!-- Action Cards -->
            <section class="action-grid">

                <!-- Tulis Artikel -->
                <div class="action-card card-article">
                    <div class="card-icon-wrap icon-article">
                        <img src="{{ asset('images/ikon tulis artikel.png') }}" alt="Tulis Artikel">
                    </div>
                    <h2 class="card-title">Write Article</h2>
                    <p class="card-desc">Share the latest agricultural knowledge and tips to help Indonesian farmers.</p>
                    <a href="/tulisartikelExpert" class="card-btn btn-article">Start Write</a>
                </div>

                <!-- Atur Jadwal -->
                <div class="action-card card-schedule">
                    <div class="card-icon-wrap icon-schedule">
                        <img src="{{ asset('images/ikon home atur jadwal.png') }}" alt="Atur Jadwal">
                    </div>
                    <h2 class="card-title">Manage Schedule</h2>
                    <p class="card-desc">Manage consultation schedules and mentoring sessions.</p>
                    <a href="{{ route('manageSchedule') }}" class="card-btn btn-schedule">Open Schedule</a>
                </div>

            </section>

        </main>

        <!-- ===== FOOTER ===== -->
        <footer class="site-footer">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-brand-top">
                        <div class="footer-logo-box">
                            <img src="images/logo.png" alt="Sproutly Logo" class="footer-logo">
                        </div>
                        <div>
                            <h3>Sproutly</h3>
                            <span>by AVI</span>
                        </div>
                    </div>
                    <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
                </div>

                <div class="footer-links">
                    <h4>About Us</h4>
                    <a href="#">Our Team</a>
                    <a href="#">Blog</a>
                    <a href="#">Privacy Policy</a>
                </div>

                <div class="footer-contact">
                    <h4>Contact</h4>
                    <p><i class="fa-solid fa-envelope"></i> sproutly@gmail.com</p>
                    <p><i class="fa-solid fa-phone"></i> +62 851 5693 2186</p>
                    <div class="social-icons">
                        <a href="#"><img src="images/instagram.jpg" alt="Instagram"></a>
                        <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                        <a href="#"><img src="images/X.jpg" alt="X"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2025 Sproutly by AVI. All rights reserved.
            </div>
        </footer>

    </div><!-- /.main-area -->
</div><!-- /.app-wrapper -->

<script src="{{ asset('js/script-homeExpert.js') }}"></script>
</body>
</html>