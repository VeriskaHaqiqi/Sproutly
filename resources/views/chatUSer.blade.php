@php
    $user = auth()->user();
    $consultations = $consultations ?? \App\Models\Konsultasi::where('user_id', $user->id)
        ->with(['ahliBotani.user'])
        ->get()
        ->map(function ($k) {
            $ahli = $k->ahliBotani;
            $avatarUrl = $ahli->user?->profile_picture ? asset('storage/' . $ahli->user->profile_picture) : null;
            return (object)[
                'id'         => $k->id,
                'name'       => $ahli->nama_ahli,
                'topic'      => $k->topik ?? 'Plant Consultation',
                'preview'    => 'Active consultation with ' . $ahli->nama_ahli . '. Click to open chat room.',
                'time'       => $k->created_at->diffForHumans(),
                'status'     => $k->status_konsultasi === 'active' ? 'active' : 'completed',
                'online'     => true,
                'read'       => false,
                'avatar'     => $avatarUrl,
                'initials'   => strtoupper(substr($ahli->nama_ahli, 0, 2)),
            ];
        });

    $activeConsultation = $activeConsultation ?? ($consultations->count() > 0 ? \App\Models\Konsultasi::where('id', $consultations->first()->id)->with(['ahliBotani.user'])->first() : null);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly — Chat Konsultasi</title>
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
      <a href="{{ url('/homeUser') }}"         class="nav-item"><span class="nav-icon">🏠</span><span>Home</span></a>
      <a href="{{ url('/consultationUser') }}" class="nav-item active"><span class="nav-icon">💬</span><span>Konsultasi</span></a>
      <a href="{{ url('/daftarArtikel') }}"                          class="nav-item"><span class="nav-icon">📰</span><span>Artikel</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}"                          class="nav-item"><span class="nav-icon">🔖</span><span>Bookmark</span></a>
      <a href="{{ url('/accountUser') }}"                          class="nav-item"><span class="nav-icon">👤</span><span>Profil</span></a>
    </nav>
    <div class="sidebar-footer">
      <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
      </form>
      <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>🚪</span> Logout</a>
    </div>
  </div>

  <!-- CHAT LAYOUT -->
  <div class="chat-layout">

    <!-- ===== PANEL KIRI: Daftar Chat ===== -->
    <div class="chat-list-panel">

      <div class="panel-header">
        <div class="panel-title">💬 Konsultasi</div>
        <button class="new-chat-btn" onclick="window.location.href='/find-experts'">＋</button>
      </div>

      <div class="chat-search-wrap">
        <span>🔍</span>
        <input type="text" placeholder="Cari percakapan..." oninput="filterChats(this.value)" />
      </div>

      <div class="chat-items" id="chat-items">
        @forelse($consultations as $item)
          <div class="chat-item {{ ($activeConsultation && $activeConsultation->id == $item->id) ? 'active' : '' }}" onclick="window.location.href='/chatUSer?id={{ $item->id }}'">
            <div class="ci-avatar">
              @if($item->avatar)
                <img src="{{ $item->avatar }}" alt="{{ $item->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
              @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#76ead0,#76d7ea);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#155a4a;font-size:14px">{{ $item->initials }}</div>
              @endif
            </div>
            <div class="ci-content">
              <div class="ci-top">
                <span class="ci-name">{{ $item->name }}</span>
                <span class="ci-time">{{ $item->time }}</span>
              </div>
              <div class="ci-preview">{{ $item->preview }}</div>
              <div class="ci-bottom">
                <span class="ci-topic">🌱 {{ $item->topic }}</span>
              </div>
            </div>
            <div class="ci-status online"></div>
          </div>
        @empty
          <div style="padding: 20px; text-align: center; color: #888;">Belum ada riwayat konsultasi.</div>
        @endforelse
      </div>
    </div>

    @if($activeConsultation)
    <!-- ===== PANEL KANAN: Area Chat ===== -->
    <div class="chat-main">

      <!-- Chat Header -->
      <div class="chat-header">
        <a href="{{ url('/consultationUser') }}" class="back-link">←</a>
        <div class="ch-avatar">
          @if($activeConsultation->ahliBotani->user?->profile_picture)
            <img src="{{ asset('storage/' . $activeConsultation->ahliBotani->user->profile_picture) }}" alt="{{ $activeConsultation->ahliBotani->nama_ahli }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
          @else
            👨‍🔬
          @endif
        </div>
        <div class="ch-info">
          <div class="ch-name">{{ $activeConsultation->ahliBotani->nama_ahli }}</div>
          <div class="ch-status">🟢 Online — {{ $activeConsultation->ahliBotani->spesialisasi ?? 'Spesialis Penyakit Tanaman' }}</div>
        </div>
        <div class="ch-actions">
          <button class="ch-btn" title="Lihat Profil" onclick="window.location.href='/profileUser?id={{ $activeConsultation->ahliBotani->id }}'">👤</button>
          <button class="ch-btn" title="Info Konsultasi" onclick="toggleInfo()">ℹ️</button>
        </div>
      </div>

      <!-- Payment Notice -->
      <div class="payment-notice" id="payment-notice">
        <div class="pn-left">
          <span class="pn-icon">💳</span>
          <div>
            <div class="pn-title">Pembayaran Diperlukan</div>
            <div class="pn-sub">Transfer Rp {{ number_format($activeConsultation->ahliBotani->tarif()->where('status_aktif', 'aktif')->first()?->tarif ?? 75000, 0, ',', '.') }} ke BCA · 1234567890 a.n. {{ $activeConsultation->ahliBotani->nama_ahli }}</div>
          </div>
        </div>
        <div class="pn-actions">
          <button class="pn-upload" onclick="document.getElementById('bukti-input').click()">📎 Upload Bukti</button>
          <input type="file" id="bukti-input" accept="image/*" style="display:none" onchange="handleBuktiUpload(this)" />
          <button class="pn-dismiss" onclick="dismissPayment()">✓ Sudah Bayar</button>
        </div>
      </div>

      <!-- Messages Area -->
      <div class="messages-area" id="messages-area">

        <!-- Date separator -->
        <div class="date-sep">Hari ini</div>

        <!-- Messages loaded from DB -->
        <div id="db-messages-container"></div>

        <!-- Typing indicator (hidden by default) -->
        <div class="msg msg-in" id="typing-indicator" style="display:none;">
          <div class="msg-avatar">
            @if($activeConsultation->ahliBotani->user?->profile_picture)
              <img src="{{ asset('storage/' . $activeConsultation->ahliBotani->user->profile_picture) }}" alt="{{ $activeConsultation->ahliBotani->nama_ahli }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
            @else
              👨‍🔬
            @endif
          </div>
          <div class="msg-bubble typing-bubble">
            <span class="dot"></span><span class="dot"></span><span class="dot"></span>
          </div>
        </div>

      </div>

      <!-- Input Area -->
      <div class="input-area">

        <div class="input-extras">
          <button class="extra-btn" title="Kirim Foto" onclick="document.getElementById('img-input').click()">📷</button>
          <input type="file" id="img-input" accept="image/*" style="display:none" onchange="handleImageUpload(this)" />
          <button class="extra-btn" title="Lampiran" onclick="document.getElementById('file-input').click()">📎</button>
          <input type="file" id="file-input" style="display:none" onchange="handleFileUpload(this)" />
        </div>

        <div class="input-wrap" id="input-wrap">
          <textarea
            id="msg-input"
            placeholder="Tulis pesan atau pertanyaan kamu..."
            rows="1"
            oninput="autoResize(this); toggleSendBtn()"
            onkeydown="handleEnter(event)"
          ></textarea>
        </div>

        <button class="send-btn" id="send-btn" onclick="sendMessage()" disabled>
          <span>➤</span>
        </button>

      </div>

    </div>

    <!-- ===== PANEL INFO (slide-in) ===== -->
    <div class="info-panel" id="info-panel">
      <div class="ip-header">
        <div class="ip-title">Info Konsultasi</div>
        <button class="ip-close" onclick="toggleInfo()">✕</button>
      </div>
      <div class="ip-avatar">
        @if($activeConsultation->ahliBotani->user?->profile_picture)
          <img src="{{ asset('storage/' . $activeConsultation->ahliBotani->user->profile_picture) }}" alt="{{ $activeConsultation->ahliBotani->nama_ahli }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        @else
          👨‍🔬
        @endif
      </div>
      <div class="ip-name">{{ $activeConsultation->ahliBotani->nama_ahli }}</div>
      <div class="ip-spec">🦠 {{ $activeConsultation->ahliBotani->spesialisasi ?? 'Spesialis Penyakit Tanaman' }}</div>
      <div class="ip-rating">⭐ {{ number_format($activeConsultation->ahliBotani->ratings->avg('nilai') ?? 4.8, 1) }} · {{ $activeConsultation->ahliBotani->ratings->count() ?? 128 }} ulasan</div>

      <div class="ip-section">
        <div class="ip-section-title">📋 Topik Konsultasi</div>
        <div class="ip-topic-badge">🌿 {{ $activeConsultation->topik ?? 'Plant Consultation' }}</div>
      </div>

      <div class="ip-section">
        <div class="ip-section-title">💳 Pembayaran</div>
        <div class="ip-pay-row"><span>Status</span><span class="pay-verified">✅ Terverifikasi</span></div>
        <div class="ip-pay-row"><span>Tarif</span><span>Rp {{ number_format($activeConsultation->ahliBotani->tarif()->where('status_aktif', 'aktif')->first()?->tarif ?? 75000, 0, ',', '.') }}</span></div>
        <div class="ip-pay-row"><span>Metode</span><span>Transfer BCA</span></div>
      </div>

      <div class="ip-section">
        <div class="ip-section-title">📅 Sesi</div>
        <div class="ip-pay-row"><span>Mulai</span><span>{{ $activeConsultation->created_at->format('d M Y, H:i') }}</span></div>
        <div class="ip-pay-row"><span>Status</span><span class="sesi-active">🟢 Aktif</span></div>
      </div>

      <button class="ip-profile-btn" onclick="window.location.href='/profileUser?id={{ $activeConsultation->ahliBotani->id }}'">
        Lihat Profil Lengkap →
      </button>
    </div>
    @else
    <div class="chat-main" style="display:flex;align-items:center;justify-content:center;color:#888;">
      <div style="text-align:center;">
        <span style="font-size:48px;">💬</span>
        <p>Pilih percakapan untuk memulai konsultasi</p>
      </div>
    </div>
    @endif

  </div>

  <script>
    const KONSULTASI_ID = {{ $activeConsultation->id }};
    const CSRF_TOKEN = '{{ csrf_token() }}';
    const expertAvatarUrl = {!! $activeConsultation && $activeConsultation->ahliBotani->user?->profile_picture ? json_encode(asset('storage/' . $activeConsultation->ahliBotani->user->profile_picture)) : 'null' !!};
    let lastMsgId = 0;

    // ---- Select chat ----
    function selectChat(el, id) {
      document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
      el.classList.add('active');
    }

    // ---- Filter chats ----
    function filterChats(query) {
      const q = query.toLowerCase();
      document.querySelectorAll('.chat-item').forEach(item => {
        const name = item.querySelector('.ci-name').textContent.toLowerCase();
        item.style.display = name.includes(q) ? '' : 'none';
      });
    }

    // ---- Load messages from DB ----
    function loadMessages() {
      fetch('/pesan/' + KONSULTASI_ID + '?after_id=0', {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(data => {
        const container = document.getElementById('db-messages-container');
        container.innerHTML = '';
        if (data.data && data.data.length > 0) {
          data.data.forEach(msg => {
            appendMessage(msg.isi_pesan || '', msg.pengirim === 'ahli' ? 'in' : 'out', msg.waktu_kirim, msg.gambar);
            if (msg.id > lastMsgId) lastMsgId = msg.id;
          });
        }
        scrollBottom();
      })
      .catch(err => console.error('Load messages error:', err));
    }

    // ---- Poll for new messages ----
    function pollMessages() {
      fetch('/pesan/' + KONSULTASI_ID + '?after_id=' + lastMsgId, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(data => {
        if (data.data && data.data.length > 0) {
          data.data.forEach(msg => {
            if (msg.id > lastMsgId) {
              if (msg.pengirim === 'ahli') {
                appendMessage(msg.isi_pesan || '', 'in', msg.waktu_kirim, msg.gambar);
              }
              lastMsgId = msg.id;
            }
          });
          scrollBottom();
        }
      })
      .catch(err => console.error('Poll error:', err));
    }

    // ---- Send message (real POST) ----
    function sendMessage() {
      const input = document.getElementById('msg-input');
      const text  = input.value.trim();
      if (!text) return;

      const now = new Date();
      const time = now.getHours().toString().padStart(2,'0') + ':' + now.getMinutes().toString().padStart(2,'0');

      // Optimistic UI
      appendMessage(text, 'out', time);
      input.value = '';
      input.style.height = 'auto';
      document.getElementById('send-btn').disabled = true;

      // POST to server
      const formData = new FormData();
      formData.append('konsultasi_id', KONSULTASI_ID);
      formData.append('isi_pesan', text);
      formData.append('_token', CSRF_TOKEN);

      fetch('/pesan', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(r => r.json())
      .then(data => {
        if (data.success && data.data.id > lastMsgId) lastMsgId = data.data.id;
      })
      .catch(err => console.error('Send error:', err));
    }

    function appendMessage(text, type, time, gambar) {
      const container = document.getElementById('db-messages-container');
      const avatarHtml = expertAvatarUrl ? `<img src="${expertAvatarUrl}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">` : '👨‍🔬';

      const div = document.createElement('div');
      div.className = `msg msg-${type}`;

      let content = '';
      if (gambar) {
        content += `<img src="${gambar}" style="max-width:200px;border-radius:8px;margin-bottom:6px;">`;
      }
      if (text) {
        content += `<div class="msg-text">${text}</div>`;
      }

      div.innerHTML = type === 'in'
        ? `<div class="msg-avatar">${avatarHtml}</div>
           <div class="msg-bubble">${content}<div class="msg-time">${time || ''}</div></div>`
        : `<div class="msg-bubble">${content}<div class="msg-time">${time || ''} ✓✓</div></div>`;

      container.appendChild(div);
      scrollBottom();
    }

    // ---- Handle Enter key ----
    function handleEnter(e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
      }
    }

    // ---- Auto resize textarea ----
    function autoResize(el) {
      el.style.height = 'auto';
      el.style.height = Math.min(el.scrollHeight, 120) + 'px';
    }

    // ---- Toggle send button ----
    function toggleSendBtn() {
      const val = document.getElementById('msg-input').value.trim();
      document.getElementById('send-btn').disabled = !val;
    }

    // ---- Image upload (real) ----
    function handleImageUpload(input) {
      if (!input.files[0]) return;
      const f = input.files[0];
      const formData = new FormData();
      formData.append('konsultasi_id', KONSULTASI_ID);
      formData.append('gambar', f);
      formData.append('isi_pesan', '');
      formData.append('_token', CSRF_TOKEN);

      const previewUrl = URL.createObjectURL(f);
      appendMessage('', 'out', '', previewUrl);
      scrollBottom();

      fetch('/pesan', { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(r => r.json()).then(data => { if (data.success && data.data.id > lastMsgId) lastMsgId = data.data.id; })
      .catch(err => console.error('Upload error:', err));
    }

    // ---- File upload ----
    function handleFileUpload(input) {
      if (!input.files[0]) return;
      handleImageUpload(input);
    }

    // ---- Bukti bayar ----
    function handleBuktiUpload(input) {
      if (!input.files[0]) return;
      dismissPayment();
      alert('Bukti pembayaran berhasil dikirim! Menunggu verifikasi... 🌱');
    }

    // ---- Dismiss payment notice ----
    function dismissPayment() {
      const notice = document.getElementById('payment-notice');
      notice.style.maxHeight = '0';
      notice.style.opacity   = '0';
      notice.style.padding   = '0 20px';
      setTimeout(() => notice.style.display = 'none', 350);
    }

    // ---- Toggle info panel ----
    let infoOpen = false;
    function toggleInfo() {
      infoOpen = !infoOpen;
      document.getElementById('info-panel').classList.toggle('open', infoOpen);
    }

    // ---- Scroll to bottom ----
    function scrollBottom() {
      const area = document.getElementById('messages-area');
      if (area) area.scrollTop = area.scrollHeight;
    }

    // ---- Init ----
    loadMessages();
    setInterval(pollMessages, 3000);
  </script>
</body>
</html>