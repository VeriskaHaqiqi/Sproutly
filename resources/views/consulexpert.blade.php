<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Requests - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-consulexpert.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-top">
                    <a href="#" class="logo-wrap">
                        <div class="logo-box">
                            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                        </div>
                        <span class="logo-text">Sproutly</span>
                    </a>
                </div>

                <nav class="sidebar-menu">
                    <a href="/dashboard-ahli" class="menu-item">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                        <span>Dashboard</span>
                    </a>

                    <a href="/consulexpert" class="menu-item active">
                        <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                        <span>Consultation</span>
                    </a>

                    <a href="/articleExpert" class="menu-item">
                        <img src="{{ asset('images/article.png') }}" alt="Article">
                        <span>Article</span>
                    </a>

                    <a href="/myarticleExpert" class="menu-item">
                        <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                        <span>My Article</span>
                    </a>

                    <a href="/setpricingexpert" class="menu-item">
                        <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                        <span>Pricing</span>
                    </a>

                    <a href="/ConsultationhistoryExpert" class="menu-item">
                        <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                        <span>Client History</span>
                    </a>

                    <a href="/accountExpert" class="menu-item">
                        <img src="{{ asset('images/settings.png') }}" alt="Setting">
                        <span>Setting</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- MAIN -->
        <div class="main-content" id="mainContent">
            <section class="consultation-section">
                <div class="consultation-header">
                    <div class="consultation-title-group">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="consultation-title-text">
                            <h1>Consultation</h1>
                            <p>Review consultation  from farmers or users.</p>
                        </div>
                    </div>
                </div>

                <div class="search-wrap">
                    <div class="search-box">
                        <span class="search-icon">⌕</span>
                        <input type="text" placeholder="Search consultation requests..." id="searchInput">
                    </div>
                </div>

                <div class="requests-list" id="requestsList">
                    @forelse($consultations as $konsul)
                    <article class="request-card" data-url="/roomChatExpert?id={{ $konsul->id }}">
                        <div class="request-left">
                            @if($konsul->user->profile_picture)
                                <img src="{{ asset('storage/' . $konsul->user->profile_picture) }}" alt="{{ $konsul->user->nama_user }}" class="avatar">
                            @else
                                <div class="avatar" style="background:linear-gradient(135deg,#76ead0,#76d7ea);display:flex;align-items:center;justify-content:center;font-weight:700;color:#155a4a;font-size:16px;border-radius:50%;width:48px;height:48px;">
                                    {{ strtoupper(substr($konsul->user->nama_user, 0, 2)) }}
                                </div>
                            @endif

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>{{ $konsul->user->nama_user }}</h3>
                                    <span class="expertise">{{ $konsul->topik ?? 'Plant Consultation' }}</span>
                                    <span class="time">{{ $konsul->created_at->diffForHumans() }}</span>
                                </div>

                                <h4>{{ $konsul->topik ?? 'Plant Consultation' }}</h4>
                                <p>
                                    @if($konsul->pesan->count() > 0)
                                        {{ Str::limit($konsul->pesan->last()->isi_pesan, 120) }}
                                    @else
                                        New consultation request. Click to start chatting.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div style="text-align:center;padding:60px 20px;color:#94a3b8;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:12px;">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                        </svg>
                        <h3 style="font-size:18px;margin-bottom:8px;color:#64748b;">No consultations yet</h3>
                        <p style="font-size:14px;">When users book a consultation with you, they will appear here.</p>
                    </div>
                    @endforelse
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-top">
                    <div class="footer-brand">
                        <div class="footer-brand-row">
                            <div class="footer-logo-circle">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                            </div>
                            <div>
                                <h2>Sproutly</h2>
                                <span>by AVI</span>
                            </div>
                        </div>
                        <p>
                            A modern agriculture consultation platform for a greener and
                            more sustainable future.
                        </p>
                    </div>

                    <div class="footer-links">
                        <h3>About Us</h3>
                        <a href="#">Our Team</a>
                        <a href="#">Blog</a>
                        <a href="#">Privacy Policy</a>
                    </div>

                    <div class="footer-contact">
                        <h3>Contact</h3>
                        <p>✉ sproutly@gmail.com</p>
                        <p>📞 +62 851 5693 2186</p>

                        <div class="social-row">
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
        </div>
    </div>

    <script src="{{ asset('js/script-consulexpert.js') }}"></script>
</body>
</html>