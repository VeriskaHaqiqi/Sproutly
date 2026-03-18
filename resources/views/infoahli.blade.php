<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Profile - Sproutly</title>

    <link rel="stylesheet" href="{{ asset('css/style-infoahli.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-top">
                <a href="#" class="brand">
                    <div class="brand-icon-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="brand-logo">
                    </div>
                    <span class="brand-text">Sproutly</span>
                </a>

                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <nav class="menu">
                <a href="/dashboard-user" class="menu-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/consultationUser" class="menu-item active">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Consultation</span>
                </a>

                <a href="/daftarArtikel" class="menu-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Article</span>
                </a>

                <a href="/bookmarkArtikelUser" class="menu-item">
                    <i class="fa-solid fa-bookmark"></i>
                    <span>Bookmarked Article</span>
                </a>

                <a href="#" class="menu-item">
                    <i class="fa-solid fa-star"></i>
                    <span>Reviews</span>
                </a>

                <a href="/payment" class="menu-item">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Payment</span>
                </a>

                <a href="#" class="menu-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="mobile-toggle" id="mobileToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1>Expert Profile</h1>
                </div>

                <div class="topbar-right">
                    <button class="notif-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notif-dot"></span>
                    </button>

                    <img src="{{ asset('images/X.jpg') }}" alt="User" class="top-avatar">
                </div>
            </header>

            <section class="profile-card">
                <div class="profile-header">
                    <div class="expert-avatar-wrap">
                        <img src="{{ asset('images/fotoprofile.png') }}" alt="Expert" class="expert-avatar">
                        <span class="online-dot"></span>
                    </div>

                    <h2>Dr. Aris Setiawan</h2>
                    <p class="expert-role">
                        <i class="fa-regular fa-lightbulb"></i>
                        Plant Pathology Specialist
                    </p>
                </div>

                <div class="profile-body">
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <div>
                                <p class="info-label">UNIVERSITY</p>
                                <h4>University of Agriculture</h4>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-briefcase"></i></div>
                            <div>
                                <p class="info-label">EXPERIENCE</p>
                                <h4>8+ years experience</h4>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-leaf"></i></div>
                            <div>
                                <p class="info-label">EXPERTISE</p>
                                <h4>Soil health, hydroponics, pest control</h4>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="info-label">LOCATION</p>
                                <h4>Jakarta, Indonesia</h4>
                            </div>
                        </div>
                    </div>

                    <div class="about-section">
                        <h3><i class="fa-regular fa-circle-info"></i> About</h3>

                        <div class="about-box">
                            <p>
                                "With nearly a decade of hands-on experience in agricultural sciences, I am dedicated to
                                empowering modern farmers through sustainable practices. My work focuses on integrating
                                cutting-edge technology with traditional soil wisdom to create resilient food systems.
                                I believe that every plant has a story, and understanding its pathology is the key to
                                a flourishing green future."
                            </p>
                        </div>
                    </div>

                    <div class="action-row">
                        <a href="/consultationUser" class="btn btn-primary">
                            <i class="fa-regular fa-square-plus"></i>
                            Start Consultation
                        </a>

                        <a href="#" class="btn btn-secondary">
                            <i class="fa-regular fa-message"></i>
                            View Reviews
                        </a>
                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="site-footer">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <div class="footer-brand-top">
                            <div class="footer-logo-box">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
                            </div>
                            <div>
                                <h3>Sproutly</h3>
                                <span>by AVI</span>
                            </div>
                        </div>

                        <p>
                            A modern agriculture consultation platform for a greener and more sustainable future.
                        </p>
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
                            <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
                            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                            <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    © 2025 Sproutly by AVI. All rights reserved.
                </div>
            </footer>
        </main>
    </div>

    <script src="{{ asset('js/infoahli.js') }}"></script>
</body>
</html>