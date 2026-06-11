<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sproutly - Detail Article</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-detailArtikelUser.css') }}">
</head>
<body>
<div class="detail-page">

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
        <button class="notif-btn" type="button" aria-label="Notifications">
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

    <!-- HERO IMAGE -->
    <section class="article-hero" id="articleHero" style="background-image: url('{{ $art->thumbnail ? (Str::startsWith($art->thumbnail, 'http') ? $art->thumbnail : asset('storage/' . $art->thumbnail)) : 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80' }}');">
      <div class="hero-overlay"></div>
    </section>

    <!-- FLOAT META -->
    <section class="article-meta-wrap">
      <div class="article-meta-card">
        <div class="article-meta-left">
          <div class="author-avatar">
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
            @endphp
            <img id="authorAvatar" src="{{ $authorAvatar }}" alt="{{ $authorName }}">
          </div>
          <div class="author-info">
            <h4 id="articleAuthor">{{ $authorName }}</h4>
            <div class="author-subinfo">
              <span id="articleDate">{{ $date }}</span>
              <span class="meta-dot"></span>
              <span id="articleReadTime">{{ $readTime }}</span>
            </div>
          </div>
        </div>
        <button class="save-btn {{ $isBookmarked ? 'saved' : '' }}" id="bookmarkBtn" type="button" data-id="{{ $art->id }}">
          <svg viewBox="0 0 24 24">
            <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
          </svg>
          <span id="bookmarkText">{{ $isBookmarked ? 'Saved' : 'Save' }}</span>
        </button>
      </div>
    </section>

    <!-- ARTICLE BODY -->
    <section class="article-shell">
      <div class="side-accent left-accent"></div>
      <div class="side-accent right-accent"></div>
      <article class="article-detail-card">
        <div class="article-inner">
          <h1 class="article-heading" id="articleTitle">{{ $art->judul }}</h1>
          
          @php
            $paragraphs = explode("\n", $art->konten);
          @endphp
          
          @foreach($paragraphs as $paragraph)
            @if(trim($paragraph))
              @if(Str::startsWith(trim($paragraph), '# '))
                <h2 class="article-subheading">{{ trim(substr(trim($paragraph), 2)) }}</h2>
              @elseif(Str::startsWith(trim($paragraph), '## '))
                <h2 class="article-subheading">{{ trim(substr(trim($paragraph), 3)) }}</h2>
              @elseif(Str::startsWith(trim($paragraph), '> '))
                <div class="quote-box">
                  <div class="quote-symbol">"</div>
                  <p>{{ trim(substr(trim($paragraph), 2)) }}</p>
                </div>
              @else
                <p class="article-text">{{ trim($paragraph) }}</p>
              @endif
            @endif
          @endforeach
        </div>
      </article>
    </section>

    <!-- RECOMMENDED — pakai <a> bukan <button> -->
    <section class="recommended-section">
      <h2>Recommended Articles</h2>
      <div class="recommended-grid">

        @foreach($recommended as $rec)
          @php
            $recAuthor = $rec->ahliBotani;
            $recAuthorName = $recAuthor->nama_ahli ?? 'Expert Botanist';
            $recAuthorAvatar = ($recAuthor && $recAuthor->user && $recAuthor->user->profile_picture) 
                ? asset('storage/' . $recAuthor->user->profile_picture) 
                : (($recAuthor && $recAuthor->user && $recAuthor->user->jenis_kelamin_user == 'P') 
                    ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' 
                    : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
            $recThumbnailUrl = $rec->thumbnail ? (Str::startsWith($rec->thumbnail, 'http') ? $rec->thumbnail : asset('storage/' . $rec->thumbnail)) : 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80';
          @endphp
          <a href="{{ route('detailArtikelUser', ['id' => $rec->id]) }}" class="recommended-card">
            <div class="recommended-image-wrap">
              <img src="{{ $recThumbnailUrl }}" alt="{{ $rec->judul }}" onerror="this.src='https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80'">
            </div>
            <div class="recommended-body">
              <span class="recommended-tag green">{{ ucfirst($rec->kategori) }}</span>
              <h3>{{ $rec->judul }}</h3>
              <p>{{ Str::limit(strip_tags($rec->konten), 90) }}</p>
              <div class="recommended-author">
                <img src="{{ $recAuthorAvatar }}" alt="{{ $recAuthorName }}">
                <div><strong>{{ $recAuthorName }}</strong></div>
              </div>
            </div>
          </a>
        @endforeach

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
<script src="{{ asset('js/detailArtikelUser.js') }}"></script>
</body>
</html>