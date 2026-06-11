<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sproutly - Article</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-daftarArtikel.css') }}">
</head>
<body>
<div class="article-page">

  <!-- SIDEBAR -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeUser') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>
    <div class="sidebar-line"></div>
    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-user') }}" class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consultationUser') }}" class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/daftarArtikel') }}" class="menu-link active"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
      <a href="{{ url('/reviewsUser') }}" class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}" class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/accountUser') }}" class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
          </svg>
        </button>
        <a href="{{ url('/accountUser') }}" class="profile-chip">
          <span class="profile-name">{{ Auth::user()->nama_user ?? 'User' }}</span>
          <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- HERO -->
    <section class="hero-section">
      <div class="hero-circle hero-circle-left"></div>
      <div class="hero-circle hero-circle-right"></div>
      <div class="hero-inner">
        <h1>Discover Agricultural <span>Knowledge</span></h1>
        <p>Explore expert articles, guides, and insights to grow your farming success</p>
        <div class="hero-search">
          <span class="hero-search-icon">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
          </span>
          <input type="text" id="articleSearch" placeholder="Search articles, topics, or keywords..." />
          <button class="hero-search-btn" type="button" id="searchButton">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- FILTER -->
    <section class="topic-section">
      <div class="topic-wrap" id="topicWrap">
        <button class="topic-chip active" data-topic="all" type="button">All Articles</button>
        <button class="topic-chip" data-topic="crop management" type="button">Crop Management</button>
        <button class="topic-chip" data-topic="soil health" type="button">Soil Health</button>
        <button class="topic-chip" data-topic="pest control" type="button">Pest Control</button>
        <button class="topic-chip" data-topic="irrigation" type="button">Irrigation</button>
        <button class="topic-chip" data-topic="sustainability" type="button">Sustainability</button>
        <button class="topic-chip" data-topic="technology" type="button">Technology</button>
      </div>
    </section>

    <!-- ARTICLE GRID -->
    <section class="article-section">
      <div class="article-grid" id="articleGrid">

        @foreach($artikel as $art)
          @php
            $author = $art->ahliBotani;
            $authorName = $author->nama_ahli ?? 'Expert Botanist';
            $authorAvatar = ($author && $author->user && $author->user->profile_picture) 
                ? asset('storage/' . $author->user->profile_picture) 
                : (($author && $author->user && $author->user->jenis_kelamin_user == 'P') 
                    ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' 
                    : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
            $date = $art->tanggal_unggah ? \Carbon\Carbon::parse($art->tanggal_unggah)->format('M d, Y') : 'Recent';
            $readTime = ceil(str_word_count(strip_tags($art->konten)) / 200) . ' min read';
            $isBookmarked = Auth::check() ? Auth::user()->bookmarkedArticles()->where('artikel_id', $art->id)->exists() : false;
            $thumbnailUrl = $art->thumbnail ? (Str::startsWith($art->thumbnail, 'http') ? $art->thumbnail : asset('storage/' . $art->thumbnail)) : 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80';
          @endphp
          <article class="article-card" 
                   data-title="{{ $art->judul }}" 
                   data-key="{{ $art->id }}" 
                   data-topic="{{ strtolower($art->kategori) }}" 
                   data-keywords="{{ strtolower($art->judul . ' ' . $art->kategori) }}" 
                   data-author="{{ $authorName }}">
            <a href="{{ route('detailArtikelUser', ['id' => $art->id]) }}" class="article-link">
              <div class="article-image-wrap">
                <img src="{{ $thumbnailUrl }}" alt="{{ $art->judul }}" onerror="this.src='https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80'">
                <span class="article-topic-label">{{ ucfirst($art->kategori) }}</span>
              </div>
              <div class="article-body">
                <h3>{{ $art->judul }}</h3>
                <p>{{ Str::limit(strip_tags($art->konten), 120) }}</p>
                <div class="article-meta">
                  <div class="author-meta">
                    <img src="{{ $authorAvatar }}" alt="{{ $authorName }}">
                    <div><strong>{{ $authorName }}</strong><span>{{ $date }}</span></div>
                  </div>
                </div>
              </div>
            </a>
            <button class="bookmark-btn {{ $isBookmarked ? 'bookmarked' : '' }}" type="button" aria-label="Bookmark article" data-id="{{ $art->id }}">
              <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
            </button>
          </article>
        @endforeach

      </div>

      <div class="empty-state hidden" id="emptyState">
        <div class="empty-icon">
          <svg viewBox="0 0 64 64" fill="none"><circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/><path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/></svg>
        </div>
        <h3>No articles found</h3>
        <p>Try another title, keyword, topic, or author name.</p>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-brand-top">
            <div class="footer-logo-box"><img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo"></div>
            <div><h3>Sproutly</h3><span>by AVI</span></div>
          </div>
          <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
        </div>
        <div class="footer-links">
          <h4>About Us</h4>
          <a href="#">Our Team</a><a href="#">Blog</a><a href="#">Privacy Policy</a>
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
      <div class="footer-bottom">&copy; 2025 Sproutly by AVI. All rights reserved.</div>
    </footer>

  </main>
</div>
<script src="{{ asset('js/script-daftarArtikel.js') }}"></script>
</body>
</html>