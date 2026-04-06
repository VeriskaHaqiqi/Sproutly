<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Dashboard - Sproutly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-dashboard-ahli.css') }}">
</head>
<body class="expert-dashboard">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="dashboard-layout">
        <aside class="sidebar-expert" id="sidebarExpert">
            <div class="sidebar-header">
                <div class="logo-wrapper">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly">
                    </div>
                    <span class="brand-text">Sproutly</span>
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ url('/expert/dashboard') }}" class="menu-item active">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/expert/consultation') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <span>Consultation</span>
                </a>
                <a href="{{ url('/expert/article') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <span>Article</span>
                </a>
                <a href="{{ url('/expert/my-article') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    <span>My Article</span>
                </a>
                <a href="{{ url('/expert/pricing') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>Pricing</span>
                </a>
                <a href="{{ url('/expert/client-history') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Client History</span>
                </a>
                <a href="{{ url('/expert/setting') }}" class="menu-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <div class="main-content" id="mainContent">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="hamburger-btn" id="hamburgerBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>
                    <div class="search-box">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Search consultations, articles, users...">
                    </div>
                </div>
                <div class="topbar-right">
                    <button class="notif-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span class="badge-notif"></span>
                    </button>
                    <div class="expert-profile">
                        <div class="profile-info">
                            <span class="expert-name">Sarah Green</span>
                            <span class="expert-label">Agriculture Expert</span>
                        </div>
                        <div class="avatar-box">
                            <img src="{{ asset('images/expert-avatar.jpg') }}" alt="Profile">
                        </div>
                    </div>
                </div>
            </header>

            <section class="hero-section">
                <div class="hero-left">
                    <h1 class="welcome-text">Welcome back, Sarah! 🌿</h1>
                    <p class="sub-welcome">Here's what's happening with your consultations today</p>
                </div>
                <div class="hero-right">
                    <div class="date-chip">Dec 21, 2026</div>
                </div>
            </section>

            <section class="stats-grid">
                <div class="stat-card orange-bg">
                    <div class="stat-icon-wrapper"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></div>
                    <div class="stat-data">
                        <h2>20</h2>
                        <p>Consultations this month</p>
                    </div>
                </div>
                <div class="stat-card green-bg">
                    <div class="stat-icon-wrapper"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
                    <div class="stat-data">
                        <h2>4.8</h2>
                        <p>Average Rating ⭐</p>
                    </div>
                </div>
                <div class="stat-card blue-bg">
                    <div class="stat-icon-wrapper"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></div>
                    <div class="stat-data">
                        <h2>20</h2>
                        <p>Published Articles</p>
                    </div>
                </div>
            </section>

            <section class="consultations-section">
                <div class="section-heading">
                    <h3>Active Consultations</h3>
                    <a href="{{ url('/expert/consultation') }}" class="view-all-link">View All</a>
                </div>
                <div class="consultation-container">
                    <div class="consult-row">
                        <div class="user-info">
                            <img src="{{ asset('images/user1.jpg') }}" alt="Client">
                            <div>
                                <h4>Michael Chen</h4>
                                <p>Organic farming consultation</p>
                            </div>
                        </div>
                        <span class="timestamp">2 hours ago</span>
                        <a href="{{ url('/expert/consultation/detail/1') }}" class="btn-detail">View Detail</a>
                    </div>
                    <div class="consult-row">
                        <div class="user-info">
                            <img src="{{ asset('images/user2.jpg') }}" alt="Client">
                            <div>
                                <h4>Emma Rodriguez</h4>
                                <p>Pest control strategies</p>
                            </div>
                        </div>
                        <span class="timestamp">5 hours ago</span>
                        <a href="{{ url('/expert/consultation/detail/2') }}" class="btn-detail">View Detail</a>
                    </div>
                    <div class="consult-row">
                        <div class="user-info">
                            <img src="{{ asset('images/user3.jpg') }}" alt="Client">
                            <div>
                                <h4>David Thompson</h4>
                                <p>Crop rotation planning</p>
                            </div>
                        </div>
                        <span class="timestamp">1 day ago</span>
                        <a href="{{ url('/expert/consultation/detail/3') }}" class="btn-detail">View Detail</a>
                    </div>
                </div>
            </section>

            <section class="quick-actions">
                <h3>Quick Actions</h3>
                <div class="action-grid">
                    <div class="action-card soft-green-bg">
                        <div class="action-icon-box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></div>
                        <h4>Manage Schedule</h4>
                        <p>Set your availability and manage consultation slots</p>
                        <a href="{{ url('/expert/schedule') }}" class="action-link">Go to Calendar <span>→</span></a>
                    </div>
                    <div class="action-card soft-lime-bg">
                        <div class="action-icon-box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                        <h4>Edit Pricing</h4>
                        <p>Update your consultation rates and packages</p>
                        <a href="{{ url('/expert/pricing') }}" class="action-link">Update Pricing <span>→</span></a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="{{ asset('js/script-dashboard-ahli.js') }}"></script>
</body>
</html>