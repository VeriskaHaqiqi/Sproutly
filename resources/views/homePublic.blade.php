<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Platform Konsultasi Pertanian Modern</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  {{-- Untuk Laravel gunakan: <link rel="stylesheet" href="{{ asset('css/sproutly.css') }}"> --}}
  <link rel="stylesheet" href="{{asset('css/style-homePublic.css') }}" />
</head>
<body>

  <!-- Background blobs -->
  <div class="blob-bg"></div>
  <div class="blob-mid"></div>

  <!-- ========================
       NAVBAR
  ========================= -->
  <nav>
    <div class="nav-logo">
      <div class="logo-icon">
        <img src="{{ asset('images/logo.png') }}" alt="logo" width="20">
      </div>
      <div>
        Sproutly
        <small>by AVI</small>
      </div>
    </div>
    <ul class="nav-links">
      <li><a href="/login" class="btn-masuk">Masuk</a></li>
    </ul>
  </nav>

  <!-- ========================
       HERO
  ========================= -->
  <section class="hero">
    <div class="hero-blob-left"></div>
    <div class="hero-blob-right"></div>
    <div class="hero-icon">🌿</div>
    <h1>Selamat Datang di Sproutly</h1>
    <p>
      Platform konsultasi pertanian modern yang menghubungkan Anda dengan para ahli
      tanaman terpercaya. Dapatkan solusi cepat untuk masalah tanaman Anda, diagnosis
      penyakit tanaman melalui foto, dan akses ribuan artikel edukatif tentang pertanian.
    </p>
    <p>
      Dengan Sproutly, berkebun menjadi lebih mudah dan menyenangkan. Kami hadir untuk
      membantu petani, hobis, dan siapa saja yang ingin mengembangkan tanaman dengan cara
      yang lebih cerdas dan efisien.
    </p>
  </section>

  <!-- ========================
       FITUR UNGGULAN
  ========================= -->
  <section class="features">
    <h2 class="section-title">Fitur Unggulan</h2>
    <div class="features-grid">

      <div class="feature-card reveal">
        <div class="feature-icon fi-teal">🎥</div>
        <h3>Konsultasi Live dengan Ahli</h3>
        <p>
          Terhubung langsung dengan para ahli tanaman berpengalaman melalui konsultasi
          real-time. Dapatkan jawaban instan untuk pertanyaan Anda tentang perawatan
          tanaman, hama, dan penyakit.
        </p>
      </div>

      <div class="feature-card reveal" style="animation-delay:.1s">
        <div class="feature-icon fi-green">📷</div>
        <h3>Diagnosis Tanaman via Foto</h3>
        <p>
          Upload foto tanaman Anda dan dapatkan diagnosis akurat dari para ahli.
          Identifikasi masalah dengan cepat dan dapatkan rekomendasi penanganan yang tepat.
        </p>
      </div>

      <div class="feature-card reveal" style="animation-delay:.2s">
        <div class="feature-icon fi-yellow">📰</div>
        <h3>Artikel Edukatif</h3>
        <p>
          Akses ribuan artikel berkualitas tentang teknik pertanian modern, tips perawatan
          tanaman, dan panduan lengkap untuk berbagai jenis tanaman.
        </p>
      </div>

      <div class="feature-card reveal" style="animation-delay:.3s">
        <div class="feature-icon fi-lime">⭐</div>
        <h3>Rating &amp; Review</h3>
        <p>
          Sistem rating transparan membantu Anda memilih ahli terbaik. Baca review dari
          pengguna lain dan bagikan pengalaman Anda untuk membantu komunitas.
        </p>
      </div>

    </div>
  </section>

  <!-- ========================
       KONSULTASI DENGAN AHLI
  ========================= -->
  <section class="experts">
    <h2 class="section-title">Konsultasi dengan Ahli Kami</h2>
    <div class="experts-grid">

      <div class="expert-card reveal">
        <div class="expert-avatar">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Sarah Wijaya" />
        </div>
        <div class="expert-name">Dr. Sarah Wijaya</div>
        <div class="expert-spec">Spesialis Hama &amp; Penyakit</div>
        <div class="stars">★★★★★ <span>(4.9)</span></div>
        <button class="btn-profile">Lihat Profil</button>
      </div>

      <div class="expert-card reveal" style="animation-delay:.1s">
        <div class="expert-avatar">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Budi Santoso, S.P." />
        </div>
        <div class="expert-name">Budi Santoso, S.P.</div>
        <div class="expert-spec">Ahli Tanaman Hias</div>
        <div class="stars">★★★★★ <span>(4.8)</span></div>
        <button class="btn-profile">Lihat Profil</button>
      </div>

      <div class="expert-card reveal" style="animation-delay:.2s">
        <div class="expert-avatar">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Ir. Maya Kusuma" />
        </div>
        <div class="expert-name">Ir. Maya Kusuma</div>
        <div class="expert-spec">Spesialis Hortikultura</div>
        <div class="stars">★★★★★ <span>(5.0)</span></div>
        <button class="btn-profile">Lihat Profil</button>
      </div>

    </div>
  </section>

  <!-- ========================
       CTA — LOGIN / REGISTER
  ========================= -->
  <div class="cta-section">
    <div class="cta-grid">

      <div class="cta-card reveal">
        <div class="cta-card-icon ci-teal">🔑</div>
        <h3>Sudah Punya Akun?</h3>
        <p>
          Masuk ke akun Anda untuk melanjutkan konsultasi, membaca artikel favorit,
          dan mengakses riwayat konsultasi Anda.
        </p>
        <a href="#" class="btn-cta-primary">Masuk Sekarang</a>
      </div>

      <div class="cta-card reveal" style="animation-delay:.1s">
        <div class="cta-card-icon ci-lime">👤</div>
        <h3>Pengguna Baru?</h3>
        <p>
          Daftar sekarang dan dapatkan akses ke semua fitur Sproutly. Konsultasi gratis
          untuk pengguna baru dan artikel eksklusif menanti Anda!
        </p>
        <a href="#" class="btn-cta-yellow">Daftar Gratis</a>
      </div>

    </div>
  </div>

  <!-- ========================
       DAFTAR ARTIKEL
  ========================= -->
  <section class="articles">
    <h2 class="section-title">Daftar Artikel</h2>
    <div class="articles-grid">

      <div class="article-card reveal">
        <div class="article-img">
          <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=400&q=80" alt="Tomat" />
        </div>
        <div class="article-body">
          <h4>Cara Merawat Tanaman Tomat di Musim Hujan</h4>
        </div>
      </div>

      <div class="article-card reveal" style="animation-delay:.1s">
        <div class="article-img">
          <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=400&q=80" alt="Tanaman Hias" />
        </div>
        <div class="article-body">
          <h4>10 Tanaman Hias Indoor yang Mudah Dirawat</h4>
        </div>
      </div>

      <div class="article-card reveal" style="animation-delay:.2s">
        <div class="article-img">
          <img src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=400&q=80" alt="Hidroponik" />
        </div>
        <div class="article-body">
          <h4>Panduan Lengkap Hidroponik untuk Pemula</h4>
        </div>
      </div>

      <div class="article-card reveal" style="animation-delay:.3s">
        <div class="article-img">
          <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80" alt="Hama" />
        </div>
        <div class="article-body">
          <h4>Mengatasi Hama Tanpa Pestisida Kimia</h4>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================
       FOOTER
  ========================= -->
  <footer>
    <div class="footer-grid">

      <div class="footer-brand">
        <div class="nav-logo">
          <div class="logo-icon">
            <img src="{{ asset('images/logo.png') }}" alt="logo" width="20">
            </div>
          <div>
            Sproutly
            <small>by AVI</small>
          </div>
        </div>
        <p>Platform konsultasi pertanian modern untuk masa depan yang lebih hijau.</p>
      </div>

      <div class="footer-col">
        <h5>Tentang Kami</h5>
        <ul>
          <li><a href="#">Tim Kami</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
        </ul>
      </div>

      <div class="footer-col footer-contact">
        <h5>Kontak</h5>
        <p>✉️ sproutly@gmail.com</p>
        <p>📞 +62 851 5693 2186</p>
        <div class="social-links">
          <a href="#" title="Instagram">
            <img src="{{ asset('images/instagram.jpg') }}" width="20"> 
            </a> 
          <a href="#" title="Facebook">
            <img src="{{ asset('images/facebook.png') }}" width="20"> 
          </a>
          <a href="#" title="X">
            <img src="{{ asset('images/X.jpg') }}" width="20"> 
          </a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      © 2025 Sproutly by AVI. All rights reserved.
    </div>
  </footer>

  <!-- JavaScript -->
  <script src="{{asset('js/script-homePublic.js')}}"></script>

</body>
</html>