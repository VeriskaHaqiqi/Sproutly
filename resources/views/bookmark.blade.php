<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly — Bookmark</title>
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
      <a href="../home/index.html"         class="nav-item"><span class="nav-icon">🏠</span><span>Home</span></a>
      <a href="../consultation/index.html" class="nav-item"><span class="nav-icon">💬</span><span>Konsultasi</span></a>
      <a href="../articles/index.html"     class="nav-item"><span class="nav-icon">📰</span><span>Artikel</span></a>
      <a href="#"                          class="nav-item active"><span class="nav-icon">🔖</span><span>Bookmark</span></a>
      <a href="#"                          class="nav-item"><span class="nav-icon">👤</span><span>Profil</span></a>
    </nav>
    <div class="sidebar-footer">
      <a href="../login/index.html" class="logout-btn"><span>🚪</span> Logout</a>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main">

    <div class="topbar">
      <div>
        <div class="topbar-title">Bookmark</div>
        <div class="topbar-sub">Artikel yang kamu simpan ada di sini 🔖</div>
      </div>
      <div class="topbar-right">
        <div class="notif-btn">🔔<span class="notif-dot"></span></div>
        <div class="user-avatar">🧑‍🌾</div>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats-bar">
      <div class="stat-item">
        <span class="stat-value" id="bookmark-count">0</span>
        <span class="stat-label">Artikel Disimpan</span>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-item">
        <span class="stat-value" id="category-count">0</span>
        <span class="stat-label">Kategori</span>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-item">
        <button class="clear-all-btn" id="clear-all-btn" onclick="clearAll()">🗑️ Hapus Semua</button>
      </div>
    </div>

    <!-- TABLE -->
    <section class="section">
      <div class="section-header">
        <div class="section-label">🔖 Artikel Tersimpan</div>
        <span class="result-count" id="result-count">0 artikel</span>
      </div>

      <div class="table-wrap" id="table-wrap">
        <table class="bookmark-table">
          <thead>
            <tr>
              <th>Artikel</th>
              <th>Kategori</th>
              <th>Penulis</th>
              <th>Tanggal Simpan</th>
              <th>Durasi Baca</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="bookmark-tbody"></tbody>
        </table>

        <!-- Empty state -->
        <div class="empty-state" id="empty-state" style="display:none;">
          <div class="empty-icon">🌵</div>
          <div class="empty-title">Belum ada artikel tersimpan</div>
          <div class="empty-sub">Tekan ikon 🏷️ di halaman artikel untuk menyimpannya di sini</div>
          <a href="../articles/index.html" class="go-articles-btn">Jelajahi Artikel →</a>
        </div>
      </div>
    </section>

  </main>

  <script src="../shared/bookmark.js"></script>
  <script>
    renderBookmarks();

    function renderBookmarks() {
      const bookmarks = getBookmarks();
      const tbody     = document.getElementById('bookmark-tbody');
      const empty     = document.getElementById('empty-state');
      const tableWrap = document.getElementById('table-wrap');
      const categories = [...new Set(bookmarks.map(b => b.category))];

      document.getElementById('bookmark-count').textContent  = bookmarks.length;
      document.getElementById('category-count').textContent  = categories.length;
      document.getElementById('result-count').textContent    = `${bookmarks.length} artikel`;

      if (bookmarks.length === 0) {
        tbody.innerHTML = '';
        document.querySelector('.bookmark-table').style.display = 'none';
        empty.style.display = 'flex';
        return;
      }

      document.querySelector('.bookmark-table').style.display = '';
      empty.style.display = 'none';

      tbody.innerHTML = bookmarks.map(article => `
        <tr class="bookmark-row" onclick="goToDetail(${article.id})">
          <td>
            <div class="td-article">
              <div class="td-emoji">${article.emoji}</div>
              <div>
                <div class="td-title">${article.title}</div>
                <div class="td-desc">${article.desc}</div>
              </div>
            </div>
          </td>
          <td><span class="cat-badge" style="background:${article.catColor};">${article.category}</span></td>
          <td>
            <div class="td-author">
              <span class="author-avatar">${article.authorAvatar}</span>
              <span class="author-name">${article.author}</span>
            </div>
          </td>
          <td><span class="td-date">${article.savedAt}</span></td>
          <td><span class="td-read">${article.readTime}</span></td>
          <td>
            <button class="remove-btn" onclick="removeBookmark(event, ${article.id})" title="Hapus dari bookmark">🗑️</button>
          </td>
        </tr>
      `).join('');
    }

    function removeBookmark(event, id) {
      event.stopPropagation();
      toggleBookmarkById(id);
      renderBookmarks();
    }

    function clearAll() {
      if (!confirm('Hapus semua bookmark? Tindakan ini tidak bisa dibatalkan.')) return;
      localStorage.removeItem('sproutly_bookmarks');
      renderBookmarks();
    }

    function goToDetail(id) {
      window.location.href = `../article-detail/index.html?id=${id}`;
    }
  </script>
</body>
</html>