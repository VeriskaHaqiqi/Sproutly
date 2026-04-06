<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation History - Sproutly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-ConsultationhistoryUser.css') }}">
</head>
<body>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('images/logo-hijau.png') }}" alt="Sproutly" class="sidebar-logo-img">
            <span class="sidebar-logo-text">Sproutly</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ url('/dashboard') }}" class="sidebar-item">
            <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard" class="sidebar-icon">
            <span>Dashboard</span>
        </a>
        <a href="{{ url('/consultation') }}" class="sidebar-item active">
            <img src="{{ asset('images/consultation.png') }}" alt="Consultation" class="sidebar-icon">
            <span>Consultation</span>
        </a>
        <a href="{{ url('/articles') }}" class="sidebar-item">
            <img src="{{ asset('images/article.png') }}" alt="Article" class="sidebar-icon">
            <span>Article</span>
        </a>
        <a href="{{ url('/bookmarks') }}" class="sidebar-item">
            <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article" class="sidebar-icon">
            <span>Bookmarked Article</span>
        </a>
        <a href="#" class="sidebar-item">
            <img src="{{ asset('images/reviews.png') }}" alt="Reviews" class="sidebar-icon">
            <span>Reviews</span>
        </a>
        <a href="#" class="sidebar-item">
            <img src="{{ asset('images/payment.png') }}" alt="Payment" class="sidebar-icon">
            <span>Payment</span>
        </a>
        <a href="#" class="sidebar-item">
            <img src="{{ asset('images/settings.png') }}" alt="Setting" class="sidebar-icon">
            <span>Setting</span>
        </a>
    </nav>
</aside>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-left">
            <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            <a href="{{ url('/home') }}" class="navbar-brand">
                <img src="{{ asset('images/logo-hijau.png') }}" alt="Sproutly" class="navbar-logo-img">
                <span class="navbar-brand-text">Sproutly</span>
            </a>
        </div>
        <div class="navbar-right">
            <button class="notif-btn" aria-label="Notifications">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </button>
            <a href="{{ url('/account') }}" class="profile-card">
                <div class="profile-info">
                    <span class="profile-name">Sarah Green</span>
                </div>
                <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile" class="profile-avatar">
            </a>
        </div>
    </header>

    <!-- Content Area -->
    <main class="content">

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Consultation History</h1>
                <p class="hero-subtitle">Track and manage your agricultural consultations</p>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="filter-section">
            <div class="filter-container">
                <div class="search-wrapper">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search consultations...">
                </div>

                <select id="statusFilter" class="filter-select">
                    <option value="">All Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Cancelled">Cancelled</option>
                </select>

                <select id="paymentFilter" class="filter-select">
                    <option value="">Payment Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Refunded">Refunded</option>
                </select>

                <div class="date-wrapper">
                    <input type="date" id="dateFilter" class="filter-date">
                    <svg class="date-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>

                <a href="{{ url('/find-expert') }}" class="btn-new-consultation">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    New Consultation
                </a>
            </div>
        </section>

        <!-- Table Section -->
        <section class="table-section">
            <div class="table-container">
                <table class="consultation-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Expert</th>
                            <th>Topic</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Populated by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <!-- Populated by JS -->
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-logo-wrap">
                    <img src="{{ asset('images/logo-hijau.png') }}" alt="Sproutly" class="footer-logo-img">
                    <span class="footer-brand-name">Sproutly</span>
                </div>
                <p class="footer-tagline">Sproutly by AVI</p>
                <p class="footer-desc">Your trusted platform for agricultural consultations and expert guidance.</p>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <h4 class="footer-col-title">About Us</h4>
                    <a href="#">Our Story</a>
                    <a href="#">Team</a>
                    <a href="#">Careers</a>
                    <a href="#">Blog</a>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Contact</h4>
                    <a href="#">Help Center</a>
                    <a href="#">Support</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>
            <div class="footer-social">
                <h4 class="footer-col-title">Follow Us</h4>
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="{{ asset('images/instagram.jpg') }}" alt="Instagram">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="{{ asset('images/X.jpg') }}" alt="X">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Sproutly by AVI. All rights reserved.</p>
        </div>
    </footer>

</div><!-- end main-wrapper -->

<!-- Modal View Details -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box" id="modalBox">
        <div class="modal-header">
            <h2 class="modal-title">Consultation Details</h2>
            <button class="modal-close" id="modalClose" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Filled by JS -->
        </div>
    </div>
</div>

<script src="{{ asset('js/script-ConsultationhistoryUser.js') }}"></script>
</body>
</html>