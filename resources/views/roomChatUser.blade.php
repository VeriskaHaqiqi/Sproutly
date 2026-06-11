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
      @foreach($activeChats as $chat)
      @php
        $chatExpert = $chat->ahliBotani;
        $chatAvatar = $chatExpert->user->profile_picture ? asset('storage/' . $chatExpert->user->profile_picture) : ($chatExpert->user->jenis_kelamin_user == 'P' ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
        $initials = implode('', array_map(function($w) { return strtoupper($w[0]); }, explode(' ', $chatExpert->nama_ahli)));
        $initials = substr($initials, 0, 2);
      @endphp
      <a href="{{ route('roomChatUser', ['id' => $chat->id]) }}" class="expert-item {{ $chat->id == $konsultasi->id ? 'active' : '' }}" style="text-decoration: none; color: inherit;">
        <div class="avatar-wrap">
          <img src="{{ $chatAvatar }}" alt="{{ $chatExpert->nama_ahli }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="avatar-initials" style="background:linear-gradient(135deg,#d0ff99,#99ff99); display: none;">{{ $initials }}</div>
          <span class="status-dot online"></span>
        </div>
        <div class="expert-info">
          <p class="expert-name">{{ $chatExpert->nama_ahli }}</p>
          <p class="expert-role">{{ $chatExpert->spesialisasi ?? 'Expert Botanist' }}</p>
          <p class="expert-status chatting">{{ $chat->status_konsultasi == 'aktif' ? 'Currently chatting' : 'Pending payment' }}</p>
        </div>
      </a>
      @endforeach
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

    <!-- Header -->
    <header class="chat-header">
      <div class="header-expert">
        @php
          $expertAvatar = $expert->user->profile_picture ? asset('storage/' . $expert->user->profile_picture) : ($expert->user->jenis_kelamin_user == 'P' ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
          $expertInitials = implode('', array_map(function($w) { return strtoupper($w[0]); }, explode(' ', $expert->nama_ahli)));
          $expertInitials = substr($expertInitials, 0, 2);
        @endphp
        <img src="{{ $expertAvatar }}" alt="{{ $expert->nama_ahli }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="header-avatar-initials" id="headerAvatar" style="background:linear-gradient(135deg,#d0ff99,#99ff99); display: none;">{{ $expertInitials }}</div>
        <div style="margin-left: 10px;">
          <p class="header-name" id="headerName">{{ $expert->nama_ahli }}</p>
          <div class="header-status">
            <span class="dot-status online" id="headerDot"></span>
            <span id="headerStatusText">Online · {{ $expert->spesialisasi ?? 'Expert Botanist' }}</span>
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

      <input type="file" id="fileInput" style="display:none;" multiple accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

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

  </div>
</div>

<script>
    window.CONSULTATION = {
        id: {{ $konsultasi->id }},
        role: "user",
        getMessagesUrl: "{{ route('consultation.messages', ['id' => $konsultasi->id]) }}",
        sendMessageUrl: "{{ route('consultation.sendMessage', ['id' => $konsultasi->id]) }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('js/script-roomChatUser.js') }}"></script>
</body>
</html>