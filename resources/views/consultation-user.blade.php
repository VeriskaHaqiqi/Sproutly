<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly — Konsultasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Fraunces:wght@700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>

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
      <a href="../home/index.html" class="nav-item"><span class="nav-icon">🏠</span><span>Home</span></a>
      <a href="#" class="nav-item active"><span class="nav-icon">💬</span><span>Konsultasi</span></a>
      <a href="#" class="nav-item"><span class="nav-icon">📰</span><span>Artikel</span></a>
      <a href="#" class="nav-item"><span class="nav-icon">🔖</span><span>Bookmark</span></a>
      <a href="#" class="nav-item"><span class="nav-icon">👤</span><span>Profil</span></a>
    </nav>
    <div class="sidebar-footer">
      <a href="../login/index.html" class="logout-btn"><span>🚪</span> Logout</a>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main">

    <div class="topbar">
      <div>
        <div class="topbar-title">Konsultasi</div>
        <div class="topbar-sub">Temukan ahli botani terbaik untuk tanamanmu 🌿</div>
      </div>
      <div class="topbar-right">
        <div class="notif-btn">🔔<span class="notif-dot"></span></div>
        <div class="user-avatar">🧑‍🌾</div>
      </div>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="search-section">
      <div class="search-wrap">
        <span class="search-icon">🔍</span>
        <input
          type="text"
          id="search-input"
          placeholder="Cari nama ahli atau spesialisasi..."
          oninput="filterExperts()"
        />
      </div>
      <div class="filter-chips">
        <button class="chip active" onclick="setFilter('semua', this)">🌿 Semua</button>
        <button class="chip" onclick="setFilter('penyakit', this)">🦠 Penyakit Tanaman</button>
        <button class="chip" onclick="setFilter('nutrisi', this)">🧪 Nutrisi</button>
        <button class="chip" onclick="setFilter('organik', this)">🌱 Pertanian Organik</button>
        <button class="chip" onclick="setFilter('tanah', this)">🪱 Ilmu Tanah</button>
        <button class="chip" onclick="setFilter('hias', this)">🌸 Tanaman Hias</button>
      </div>
    </div>

    <!-- STATS BAR -->
    <div class="stats-bar">
      <div class="stat-item">
        <span class="stat-value" id="expert-count">6</span>
        <span class="stat-label">Ahli Tersedia</span>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-item">
        <span class="stat-value">⭐ 4.8</span>
        <span class="stat-label">Rating Rata-rata</span>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-item">
        <span class="stat-value">🟢 4</span>
        <span class="stat-label">Sedang Online</span>
      </div>
    </div>

    <!-- EXPERT TABLE -->
    <section class="section">
      <div class="section-header">
        <div class="section-label">👨‍🔬 Daftar Ahli Botani</div>
        <span class="result-count" id="result-count">Menampilkan 6 ahli</span>
      </div>

      <div class="table-wrap">
        <table class="expert-table">
          <thead>
            <tr>
              <th>Ahli</th>
              <th>Spesialisasi</th>
              <th>Keahlian</th>
              <th>Rating</th>
              <th>Tarif</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="expert-tbody">

            <tr class="expert-row" data-specialization="penyakit" onclick="goToProfile('amara')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👨‍🔬</div>
                  <div>
                    <div class="td-name">Dr. Amara Wijaya</div>
                    <div class="td-reviews">128 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🦠 Penyakit Tanaman</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">Tomat</span>
                  <span class="etag">Cabai</span>
                  <span class="etag">Jamur</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.9</span></td>
              <td><span class="td-price">Rp 75.000</span></td>
              <td><span class="status-badge online">🟢 Online</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('amara')">Konsultasi</button>
              </td>
            </tr>

            <tr class="expert-row" data-specialization="nutrisi" onclick="goToProfile('sari')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👩‍🔬</div>
                  <div>
                    <div class="td-name">Dr. Sari Pertiwi</div>
                    <div class="td-reviews">95 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🧪 Nutrisi Tanaman</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">Pupuk</span>
                  <span class="etag">Hidroponik</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.8</span></td>
              <td><span class="td-price">Rp 85.000</span></td>
              <td><span class="status-badge online">🟢 Online</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('sari')">Konsultasi</button>
              </td>
            </tr>

            <tr class="expert-row" data-specialization="tanah" onclick="goToProfile('budi')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👨‍🌾</div>
                  <div>
                    <div class="td-name">Dr. Budi Santoso</div>
                    <div class="td-reviews">87 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🪱 Ilmu Tanah</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">pH Tanah</span>
                  <span class="etag">Kompos</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.7</span></td>
              <td><span class="td-price">Rp 70.000</span></td>
              <td><span class="status-badge online">🟢 Online</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('budi')">Konsultasi</button>
              </td>
            </tr>

            <tr class="expert-row" data-specialization="organik" onclick="goToProfile('rina')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👩‍🌾</div>
                  <div>
                    <div class="td-name">Dr. Rina Kusuma</div>
                    <div class="td-reviews">212 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🌱 Pertanian Organik</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">Pestisida Alami</span>
                  <span class="etag">Mulsa</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.9</span></td>
              <td><span class="td-price">Rp 90.000</span></td>
              <td><span class="status-badge offline">⚫ Offline</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('rina')">Konsultasi</button>
              </td>
            </tr>

            <tr class="expert-row" data-specialization="hias" onclick="goToProfile('dewi')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👩‍🎨</div>
                  <div>
                    <div class="td-name">Dr. Dewi Lestari</div>
                    <div class="td-reviews">64 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🌸 Tanaman Hias</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">Anggrek</span>
                  <span class="etag">Sukulen</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.6</span></td>
              <td><span class="td-price">Rp 65.000</span></td>
              <td><span class="status-badge online">🟢 Online</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('dewi')">Konsultasi</button>
              </td>
            </tr>

            <tr class="expert-row" data-specialization="penyakit" onclick="goToProfile('hendra')">
              <td>
                <div class="td-expert">
                  <div class="td-avatar">👨‍💼</div>
                  <div>
                    <div class="td-name">Dr. Hendra Putra</div>
                    <div class="td-reviews">143 ulasan</div>
                  </div>
                </div>
              </td>
              <td><span class="td-spec">🦠 Penyakit Tanaman</span></td>
              <td>
                <div class="td-tags">
                  <span class="etag">Virus</span>
                  <span class="etag">Bakteri</span>
                  <span class="etag">Padi</span>
                </div>
              </td>
              <td><span class="td-rating">⭐ 4.8</span></td>
              <td><span class="td-price">Rp 80.000</span></td>
              <td><span class="status-badge offline">⚫ Offline</span></td>
              <td>
                <button class="consult-btn" onclick="event.stopPropagation(); goToProfile('hendra')">Konsultasi</button>
              </td>
            </tr>

          </tbody>
        </table>

        <!-- Empty state -->
        <div class="empty-state" id="empty-state" style="display:none;">
          <div class="empty-icon">🌵</div>
          <div class="empty-title">Ahli tidak ditemukan</div>
          <div class="empty-sub">Coba kata kunci atau filter yang berbeda</div>
        </div>

      </div>
    </section>
  </main>

  <script>
    let activeFilter = 'semua';

    function setFilter(filter, el) {
      activeFilter = filter;
      document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
      el.classList.add('active');
      filterExperts();
    }

    function filterExperts() {
      const query = document.getElementById('search-input').value.toLowerCase();
      const rows  = document.querySelectorAll('.expert-row');
      let visible = 0;

      rows.forEach(row => {
        const name   = row.querySelector('.td-name').textContent.toLowerCase();
        const spec   = row.querySelector('.td-spec').textContent.toLowerCase();
        const tags   = row.querySelector('.td-tags').textContent.toLowerCase();
        const filter = row.dataset.specialization;

        const matchFilter = activeFilter === 'semua' || filter === activeFilter;
        const matchQuery  = !query || name.includes(query) || spec.includes(query) || tags.includes(query);

        if (matchFilter && matchQuery) {
          row.style.display = '';
          visible++;
        } else {
          row.style.display = 'none';
        }
      });

      document.getElementById('expert-count').textContent = visible;
      document.getElementById('result-count').textContent = `Menampilkan ${visible} ahli`;
      document.getElementById('empty-state').style.display = visible === 0 ? 'flex' : 'none';
    }

    function goToProfile(id) {
      window.location.href = `../expert-profile/index.html?id=${id}`;
    }
  </script>
</body>
</html>