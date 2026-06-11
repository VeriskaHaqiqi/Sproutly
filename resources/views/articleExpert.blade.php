<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - Sproutly Expert</title>

    <link rel="stylesheet" href="{{ asset('css/style-articleExpert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
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
                <a href="{{ url('/dashboard-ahli') }}" class="menu-link">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/consulexpert') }}" class="menu-link">
                    <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                    <span>Consultation</span>
                </a>

                <a href="{{ url('/articleExpert') }}" class="menu-link active">
                    <img src="{{ asset('images/article.png') }}" alt="Article">
                    <span>Article</span>
                </a>

                <a href="{{ url('/myarticleExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                    <span>My Article</span>
                </a>

                <a href="{{ url('/setpricingexpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                    <span>Pricing</span>
                </a>

                <a href="{{ url('/ConsultationhistoryExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                    <span>Client History</span>
                </a>

                <a href="{{ url('/accountExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/settings.png') }}" alt="Setting">
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="main-content shifted" id="mainContent">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle Sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" placeholder="Search article title...">
                    </div>
                </div>

                <div class="topbar-right">
                    <select id="categoryFilter" class="filter-select">
                        <option value="all">All Categories</option>
                        <option value="Horticulture">Horticulture</option>
                        <option value="Tech Integration">Tech Integration</option>
                        <option value="Urban Planning">Urban Planning</option>
                        <option value="IoT & Sensors">IoT & Sensors</option>
                        <option value="Organic Care">Organic Care</option>
                        <option value="Education">Education</option>
                    </select>

                    <select id="statusFilter" class="filter-select">
                        <option value="all">All Status</option>
                        <option value="Published">Published</option>
                        <option value="Draft">Draft</option>
                        <option value="Archived">Archived</option>
                    </select>

                    <div class="date-filter-group">
                        <input type="date" id="startDate" class="date-input" aria-label="Start date">
                        <span class="date-separator">to</span>
                        <input type="date" id="endDate" class="date-input" aria-label="End date">
                    </div>

                    <button class="icon-btn" id="resetFilterBtn" type="button" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </div>
            </header>

            <main class="page-content">
                <section class="heading-row">
                    <div>
                        <h1>Articles</h1>
                        <p>Create, manage, and explore your articles</p>
                    </div>

                    <a href="{{ url('/tulisartikelExpert') }}" class="new-article-btn">
                        <i class="fa-solid fa-plus"></i>
                        New Article
                    </a>
                </section>

                <div class="divider"></div>

                <section class="meta-row">
                    <p id="resultsCount">Showing 0 articles</p>
                    <div class="pagination" id="pagination"></div>
                </section>

                <section class="article-grid" id="articleGrid">
                    @forelse($artikel as $art)
                        @php
                            $tagClass = '';
                            $kat = strtolower($art->kategori);
                            if (str_contains($kat, 'tech') || str_contains($kat, 'integration')) $tagClass = 'tag-blue';
                            elseif (str_contains($kat, 'urban') || str_contains($kat, 'planning') || str_contains($kat, 'hydro')) $tagClass = 'tag-green';
                            elseif (str_contains($kat, 'iot') || str_contains($kat, 'sensor')) $tagClass = 'tag-yellow';
                            elseif (str_contains($kat, 'organic') || str_contains($kat, 'care')) $tagClass = 'tag-lime';
                            elseif (str_contains($kat, 'education') || str_contains($kat, 'learning')) $tagClass = 'tag-pink';

                            $thumbnailUrl = $art->thumbnail ? (Str::startsWith($art->thumbnail, 'http') ? $art->thumbnail : asset('storage/' . $art->thumbnail)) : 'https://images.unsplash.com/photo-1512428813834-c702c7702b78?auto=format&fit=crop&w=1200&q=80';
                            $dateStr = $art->tanggal_unggah ? \Carbon\Carbon::parse($art->tanggal_unggah)->format('Y-m-d') : '2023-10-12';
                            $dateDisplay = $art->tanggal_unggah ? \Carbon\Carbon::parse($art->tanggal_unggah)->format('M d, Y') : 'Recent';

                            $wordCount = str_word_count(strip_tags($art->konten));
                            $readTime = max(1, ceil($wordCount / 200)) . ' min read';
                        @endphp
                        <article class="article-card"
                            data-title="{{ $art->judul }}"
                            data-category="{{ $art->kategori }}"
                            data-status="Published"
                            data-date="{{ $dateStr }}">
                            <div class="article-thumb">
                                <img src="{{ $thumbnailUrl }}" alt="{{ $art->judul }}" onerror="this.src='https://images.unsplash.com/photo-1512428813834-c702c7702b78?auto=format&fit=crop&w=1200&q=80'">
                                <span class="article-tag {{ $tagClass }}">{{ strtoupper($art->kategori) }}</span>
                            </div>
                            <div class="article-body">
                                <div class="article-meta">
                                    {{ $dateDisplay }} <span>•</span> {{ $readTime }}
                                </div>
                                <div class="article-topline">
                                    <h3>{{ $art->judul }}</h3>
                                    <span class="article-status published">Published</span>
                                </div>
                                <p>{{ Str::limit(strip_tags($art->konten), 90) }}</p>
                                <a href="/detailArtikelUser?id={{ $art->id }}" class="edit-link">View Article <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @empty
                        <!-- Handled by emptyState div -->
                    @endforelse
                </section>

                <div class="empty-state" id="emptyState">
                    <i class="fa-regular fa-folder-open"></i>
                    <h3>No articles found</h3>
                    <p>Try changing the search keyword or filter combination.</p>
                </div>
            </main>

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
        </div>
    </div>

    <script src="{{ asset('js/articleExpert.js') }}"></script>
</body>
</html>