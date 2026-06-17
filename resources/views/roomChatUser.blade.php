<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Consultation Chat</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-roomChatUser.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="app-wrapper">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">

    <a href="{{ url('/consultationUser') }}" class="back-btn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 12H5"/>
        <path d="M12 5L5 12L12 19"/>
      </svg>
      Back to Consultations
    </a>

    <div class="expert-list">

      @if(isset($consultations))
        @foreach($consultations as $con)
          <div class="expert-item {{ isset($activeConsultation) && $activeConsultation->id == $con->id ? 'active' : '' }}" 
               data-expert="db-{{ $con->id }}"
               onclick="window.location.href='/roomChatUser?id={{ $con->id }}'">
            <div class="avatar-wrap">
              @if($con->ahliBotani->user?->profile_picture)
                <img src="{{ asset('storage/' . $con->ahliBotani->user->profile_picture) }}" alt="{{ $con->ahliBotani->nama_ahli }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
              @else
                <div class="avatar-initials" style="background:linear-gradient(135deg,#76ead0,#76d7ea);">{{ strtoupper(substr($con->ahliBotani->nama_ahli, 0, 2)) }}</div>
              @endif
              <span class="status-dot online"></span>
            </div>
            <div class="expert-info">
              <p class="expert-name">{{ $con->ahliBotani->nama_ahli }}</p>
              <p class="expert-role">{{ $con->ahliBotani->spesialisasi ?? 'Expert Botanist' }}</p>
              <p class="expert-status chatting">Currently chatting</p>
            </div>
          </div>
        @endforeach
      @endif

      @if(!isset($consultations) || $consultations->count() === 0)
      <div style="text-align:center;padding:40px 16px;color:#94a3b8;font-size:13px;">
          No active consultations.<br>
          <a href="{{ url('/find-experts') }}" style="color:#76ead0;text-decoration:underline;margin-top:8px;display:inline-block;">Find an expert</a>
      </div>
      @endif

    </div>

    <div class="sidebar-footer">
      <a href="{{ url('/find-experts') }}" class="find-expert-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <path d="M21 21L16.65 16.65"/>
        </svg>
        Find More Experts
      </a>
    </div>

  </aside>

  <!-- ── CHAT MAIN ── -->
  <div class="chat-main">

    @if(isset($activeConsultation) && $activeConsultation)
    <!-- Header -->
    <header class="chat-header">
      <div class="header-expert">
        <div class="header-avatar-initials" id="headerAvatar" style="background:linear-gradient(135deg,#76ead0,#76d7ea);">
          {{ strtoupper(substr($activeConsultation->ahliBotani->nama_ahli, 0, 2)) }}
        </div>
        <div>
          <p class="header-name" id="headerName">{{ $activeConsultation->ahliBotani->nama_ahli }}</p>
          <div class="header-status">
            <span class="dot-status online" id="headerDot"></span>
            <span id="headerStatusText">Online · {{ $activeConsultation->ahliBotani->spesialisasi ?? 'Expert Botanist' }}</span>
          </div>
        </div>
      </div>
    </header>

    <!-- Messages -->
    <div class="messages-area" id="messagesArea"></div>

    <!-- Input bar -->
    <div class="input-bar">
      <button class="btn-attach" id="btnAttach" title="Attach file">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21.44 11.05L12.25 20.24a6 6 0 01-8.49-8.49L14.08 2.43a4 4 0 015.66 5.66L9.41 18.41a2 2 0 01-2.83-2.83L16.07 6.1"/>
        </svg>
      </button>

      <input type="file" id="fileInput" style="display:none;" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

      <button class="btn-emoji" id="btnEmoji" title="Emoji">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
          <line x1="9" y1="9" x2="9.01" y2="9"/>
          <line x1="15" y1="9" x2="15.01" y2="9"/>
        </svg>
      </button>

      <input type="text" class="message-input" id="messageInput" placeholder="Type your message..." autocomplete="off"/>

      <button class="btn-send" id="btnSend" title="Send">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 2L11 13"/>
          <path d="M22 2L15 22L11 13L2 9L22 2Z"/>
        </svg>
      </button>
    </div>

    @else
    <!-- NO ACTIVE CONSULTATION -->
    <div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;color:#94a3b8;gap:12px;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        <p style="font-size:16px;font-weight:500;">No active consultation</p>
        <a href="{{ url('/find-experts') }}" style="color:#76ead0;text-decoration:underline;">Find an expert to start</a>
    </div>
    @endif

  </div>
</div>

<script>
  window.DB_CONSULTATION = {!! json_encode($activeConsultation ? [
      'id' => $activeConsultation->id,
      'expert' => [
          'name' => $activeConsultation->ahliBotani->nama_ahli,
          'role' => $activeConsultation->ahliBotani->spesialisasi ?? 'Expert Botanist',
          'initials' => strtoupper(substr($activeConsultation->ahliBotani->nama_ahli, 0, 2)),
          'avatarBg' => 'linear-gradient(135deg,#76ead0,#76d7ea)',
          'status' => 'online',
          'statusText' => 'Online · ' . ($activeConsultation->ahliBotani->spesialisasi ?? 'Expert Botanist'),
      ]
  ] : null) !!};

  window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script-roomChatUser.js') }}"></script>
</body>
</html>