@php
  $expert = $expert ?? (auth()->check() && auth()->user()->role === 'ahli' ? auth()->user()->ahliBotani : \App\Models\AhliBotani::with('user')->first());
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly — Profil Ahli</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Fraunces:wght@700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>
<body>

  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">🌱</div>
      <div>
        <div class="logo-name">Sproutly</div>
        <div class="logo-sub">by AVI</div>
      </div>
    </div>
    <nav class="nav">
      <a href="{{ url('/homeUser') }}" class="nav-item"><span class="nav-icon">🏠</span><span>Home</span></a>
      <a href="{{ url('/consultationUser') }}" class="nav-item active"><span class="nav-icon">💬</span><span>Konsultasi</span></a>
      <a href="{{ url('/daftarArtikel') }}" class="nav-item"><span class="nav-icon">📰</span><span>Artikel</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="nav-item"><span class="nav-icon">🔖</span><span>Bookmark</span></a>
      <a href="{{ url('/accountUser') }}" class="nav-item"><span class="nav-icon">👤</span><span>Profil</span></a>
    </nav>
    <div class="sidebar-footer">
      <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
      </form>
      <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>🚪</span> Logout</a>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main">

    <!-- Back button -->
    <a href="{{ url('/find-experts') }}" class="back-btn">
      <span>←</span> Kembali ke Daftar Ahli
    </a>

    <div class="profile-layout">

      <!-- LEFT: Profile Card -->
      <div class="profile-left">

        <div class="profile-card">
          <div class="profile-status-badge">🟢 Online</div>
          <div class="profile-avatar">
            @if($expert->user?->profile_picture)
              <img src="{{ asset('storage/' . $expert->user->profile_picture) }}" alt="{{ $expert->nama_ahli }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
            @else
              👨‍🔬
            @endif
          </div>
          <div class="profile-name">{{ $expert->nama_ahli }}</div>
          <div class="profile-title">{{ $expert->spesialisasi ?? 'Spesialis Penyakit Tanaman' }}</div>
          <div class="profile-rating-row">
            <span class="profile-rating">⭐ {{ number_format($expert->ratings->avg('nilai') ?? 4.8, 1) }}</span>
            <span class="profile-reviews">{{ $expert->ratings->count() ?? 128 }} ulasan</span>
          </div>

          <div class="profile-stats">
            <div class="pstat">
              <div class="pstat-val">{{ $expert->pengalaman_tahun ?? '5' }}+</div>
              <div class="pstat-label">Tahun Pengalaman</div>
            </div>
            <div class="pstat-divider"></div>
            <div class="pstat">
              <div class="pstat-val">{{ $expert->ratings->count() * 3 ?? 150 }}+</div>
              <div class="pstat-label">Konsultasi</div>
            </div>
            <div class="pstat-divider"></div>
            <div class="pstat">
              <div class="pstat-val">98%</div>
              <div class="pstat-label">Kepuasan</div>
            </div>
          </div>

          <div class="profile-price-box">
            <div class="price-label">Tarif Konsultasi</div>
            <div class="price-value">Rp {{ number_format($expert->tarif()->where('status_aktif', 'aktif')->first()?->tarif ?? 75000, 0, ',', '.') }}<span class="price-per">/sesi</span></div>
          </div>

          <!-- Payment Info -->
          <div class="payment-info">
            <div class="payment-title">💳 Info Pembayaran</div>
            <div class="payment-row"><span class="payment-label">Bank</span><span class="payment-val">BCA</span></div>
            <div class="payment-row"><span class="payment-label">No. Rekening</span><span class="payment-val">1234567890</span></div>
            <div class="payment-row"><span class="payment-label">Atas Nama</span><span class="payment-val">{{ $expert->nama_ahli }}</span></div>
          </div>

          <button class="start-consult-btn" onclick="window.location.href='/lockRoomUser?expert_id={{ $expert->id }}'">
            💬 Mulai Konsultasi
          </button>
          <button class="book-btn" onclick="alert('Jadwal konsultasi segera tersedia 🌿')">
            📅 Buat Janji Temu
          </button>
        </div>

      </div>

      <!-- RIGHT: Detail -->
      <div class="profile-right">

        <!-- Tentang -->
        <div class="detail-card">
          <div class="detail-title">📋 Tentang</div>
          <p class="detail-text">
            {{ $expert->bio ?? 'Beliau adalah ahli botani berpengalaman yang mengkhususkan diri dalam diagnosis dan penanganan penyakit tanaman.' }}
          </p>
        </div>

        <!-- Spesialisasi -->
        <div class="detail-card">
          <div class="detail-title">🔬 Spesialisasi</div>
          <div class="spec-grid">
            <div class="spec-item">🦠<span>Penyakit Jamur</span></div>
            <div class="spec-item">🦠<span>Penyakit Bakteri</span></div>
            <div class="spec-item">🍅<span>Tanaman Tomat</span></div>
            <div class="spec-item">🌶️<span>Tanaman Cabai</span></div>
            <div class="spec-item">🌾<span>Tanaman Padi</span></div>
            <div class="spec-item">🧫<span>Diagnosa Virus</span></div>
          </div>
        </div>

        <!-- Pendidikan -->
        <div class="detail-card">
          <div class="detail-title">🎓 Pendidikan</div>
          <div class="timeline">
            <div class="timeline-item">
              <div class="timeline-dot" style="background:linear-gradient(135deg,#99ff99,#76ead0);"></div>
              <div>
                <div class="timeline-title">S3 Ilmu Tanaman — Universitas Gadjah Mada</div>
                <div class="timeline-year">2015 – 2019</div>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-dot" style="background:linear-gradient(135deg,#d0ff99,#99ff99);"></div>
              <div>
                <div class="timeline-title">S2 Proteksi Tanaman — IPB University</div>
                <div class="timeline-year">2012 – 2014</div>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-dot" style="background:linear-gradient(135deg,#ffff9f,#d0ff99);"></div>
              <div>
                <div class="timeline-title">S1 Agroteknologi — Universitas Brawijaya</div>
                <div class="timeline-year">2008 – 2012</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Jadwal -->
        <div class="detail-card">
          <div class="detail-title">📅 Jadwal Tersedia</div>
          <div class="schedule-grid">
            <div class="sched-day active-day">
              <div class="sched-name">Sen</div>
              <div class="sched-time">09.00–17.00</div>
            </div>
            <div class="sched-day active-day">
              <div class="sched-name">Sel</div>
              <div class="sched-time">09.00–17.00</div>
            </div>
            <div class="sched-day active-day">
              <div class="sched-name">Rab</div>
              <div class="sched-time">10.00–15.00</div>
            </div>
            <div class="sched-day inactive-day">
              <div class="sched-name">Kam</div>
              <div class="sched-time">Libur</div>
            </div>
            <div class="sched-day active-day">
              <div class="sched-name">Jum</div>
              <div class="sched-time">08.00–16.00</div>
            </div>
            <div class="sched-day inactive-day">
              <div class="sched-name">Sab</div>
              <div class="sched-time">Libur</div>
            </div>
            <div class="sched-day inactive-day">
              <div class="sched-name">Min</div>
              <div class="sched-time">Libur</div>
            </div>
          </div>
        </div>

        <!-- Ulasan -->
        <div class="detail-card">
          <div class="detail-title">⭐ Ulasan Pengguna</div>
          <div class="review-list">

            <div class="review-item">
              <div class="review-top">
                <div class="reviewer-avatar">🧑</div>
                <div>
                  <div class="reviewer-name">Budi S.</div>
                  <div class="review-stars">⭐⭐⭐⭐⭐</div>
                </div>
                <div class="review-date">20 Feb 2026</div>
              </div>
              <div class="review-text">Dr. Amara sangat membantu! Tanaman tomat saya yang terserang jamur berhasil sembuh berkat sarannya. Responsif dan penjelasannya mudah dimengerti.</div>
            </div>

            <div class="review-item">
              <div class="review-top">
                <div class="reviewer-avatar">👩</div>
                <div>
                  <div class="reviewer-name">Siti R.</div>
                  <div class="review-stars">⭐⭐⭐⭐⭐</div>
                </div>
                <div class="review-date">15 Feb 2026</div>
              </div>
              <div class="review-text">Diagnosis yang tepat dan solusi yang praktis. Sangat puas dengan pelayanannya!</div>
            </div>

            <div class="review-item">
              <div class="review-top">
                <div class="reviewer-avatar">🧔</div>
                <div>
                  <div class="reviewer-name">Hendra P.</div>
                  <div class="review-stars">⭐⭐⭐⭐</div>
                </div>
                <div class="review-date">10 Feb 2026</div>
              </div>
              <div class="review-text">Konsultasi berjalan lancar. Sedikit menunggu tapi hasilnya memuaskan.</div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </main>

  <script>
    // Load expert based on URL param
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    // In production, fetch expert data by id here
  </script>
</body>
</html>