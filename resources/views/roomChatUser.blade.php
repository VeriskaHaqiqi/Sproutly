{{-- resources/views/consultation/chatroom.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Chat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-roomChatUser.css') }}">
</head>
<body>

<div class="app-wrapper">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar">

        <a href="/consultationUser" class="back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            <span>Back to Menu</span>
        </a>

        <div class="expert-list">

            <div class="expert-item" data-expert="marcus">
                <div class="avatar-wrap">
                    <img src="{{ asset('images/fotoprofile.png') }}" class="avatar-initials">
                    <span class="status-dot online"></span>
                </div>
                <div class="expert-info">
                    <p class="expert-name">Dr. Marcus Chen</p>
                    <p class="expert-role">Crop Disease Specialist</p>
                    <p class="expert-status available">Available now</p>
                </div>
            </div>

            <div class="expert-item active" data-expert="sarah">
                <div class="avatar-wrap">
                    <img src="{{ asset('images/fotoprofile.png') }}" class="avatar-initials">
                    <span class="status-dot online"></span>
                </div>
                <div class="expert-info">
                    <p class="expert-name">Dr. Sarah Williams</p>
                    <p class="expert-role">Soil Health Expert</p>
                    <p class="expert-status chatting">Currently chatting</p>
                </div>
            </div>

            <div class="expert-item" data-expert="james">
                <div class="avatar-wrap">
                    <img src="{{ asset('images/fotoprofile.png') }}" class="avatar-initials">
                    <span class="status-dot away"></span>
                </div>
                <div class="expert-info">
                    <p class="expert-name">Dr. James Rodriguez</p>
                    <p class="expert-role">Pest Management</p>
                    <p class="expert-status away-status">Away · 2 hours</p>
                </div>
            </div>

            <div class="expert-item" data-expert="emma">
                <div class="avatar-wrap">
                    <img src="{{ asset('images/fotoprofile.png') }}" class="avatar-initials">
                    <span class="status-dot offline"></span>
                </div>
                <div class="expert-info">
                    <p class="expert-name">Dr. Emma Thompson</p>
                    <p class="expert-role">Organic Farming</p>
                    <p class="expert-status offline-status">Offline</p>
                </div>
            </div>

        </div>

        <div class="sidebar-footer">
            <a href="/consultationUser" class="find-expert-btn">
                    Find Expert
            </a>
        </div>

    </aside>

    {{-- ===== MAIN CHAT AREA ===== --}}
    <main class="chat-main">

        <div class="chat-header">
            <div class="header-expert">
                <div class="header-avatar-initials" id="headerAvatar">SW</div>
                <div class="header-info">
                    <h2 class="header-name" id="headerName">Dr. Sarah Williams</h2>
                    <p class="header-status">
                        <span class="dot-status" id="headerDot"></span>
                        <span id="headerStatusText">Online · Soil Health Expert</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="messages-area" id="messagesArea"></div>

        <div class="input-bar">
            <button class="btn-attach" id="btnAttach" title="Attach file">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/></svg>
            </button>
            <input type="text" id="messageInput" class="message-input" placeholder="Type your message..." autocomplete="off">
            <button class="btn-emoji" id="btnEmoji" title="Emoji">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 13s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
            </button>
            <button class="btn-send" id="btnSend" title="Send">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M2 21L23 12 2 3v7l15 2-15 2v7z"/></svg>
            </button>
        </div>

    </main>
</div>

<input type="file" id="fileInput" accept="image/*,.pdf,.doc,.docx" style="display:none">
<script src="{{ asset('js/script-roomChatUser.js') }}"></script>
</body>
</html>