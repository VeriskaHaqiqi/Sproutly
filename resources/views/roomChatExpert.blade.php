<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Consultation Chat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-roomChatExpert.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

{{-- SVG ICON SPRITE --}}
<svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">
    <symbol id="icon-arrow-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 18 9 12 15 6"/>
    </symbol>
    <symbol id="icon-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </symbol>
    <symbol id="icon-more" viewBox="0 0 24 24" fill="currentColor">
        <circle cx="12" cy="5"  r="1.8"/>
        <circle cx="12" cy="12" r="1.8"/>
        <circle cx="12" cy="19" r="1.8"/>
    </symbol>
    <symbol id="icon-x-circle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="15" y1="9"  x2="9"  y2="15"/>
        <line x1="9"  y1="9"  x2="15" y2="15"/>
    </symbol>
    <symbol id="icon-plus-circle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8"  x2="12" y2="16"/>
        <line x1="8"  y1="12" x2="16" y2="12"/>
    </symbol>
    <symbol id="icon-smile" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
        <line x1="9"  y1="9"  x2="9.01"  y2="9"/>
        <line x1="15" y1="9"  x2="15.01" y2="9"/>
    </symbol>
    <symbol id="icon-send" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="22" y1="2" x2="11" y2="13"/>
        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
    </symbol>
    <symbol id="icon-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 20A7 7 0 0 1 4 13c0-4 3-9 8-11 5 2 8 7 8 11a7 7 0 0 1-7 7z"/>
        <path d="M11 20c0-4 2-8 4-10"/>
    </symbol>
</svg>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-header">
        <a href="/consulexpert" class="back-btn">
            <svg class="icon-sm" aria-hidden="true"><use href="#icon-arrow-left"/></svg>
            <span>Back to Menu</span>
        </a>
    </div>

    <div class="search-bar">
        <svg class="icon-search-svg" aria-hidden="true"><use href="#icon-search"/></svg>
        <input type="text" placeholder="Search consultations..." id="searchInput">
    </div>

    <div class="sidebar-section">
        <span class="section-label">RECENT CHATS</span>
        <span class="active-badge">3 ACTIVE</span>
    </div>

    <div class="chat-list" id="chatList">

        <div class="chat-item active" data-room="sarah" onclick="switchRoom('sarah')">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="SJ" data-color="0">
                    <img src="{{ asset('image/avatar-sarah.png') }}" alt="Sarah Johnson" class="avatar-img" onerror="this.style.display='none'">
                </div>
                <span class="status-dot online"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">Sarah Johnson</span>
                    <span class="chat-time">2m ago</span>
                </div>
                <span class="chat-topic">Tomato Plant Issue</span>
                <span class="chat-status active-label">Active</span>
            </div>
        </div>

        <div class="chat-item" data-room="marcus" onclick="switchRoom('marcus')">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="MC" data-color="1">
                    <img src="{{ asset('image/avatar-marcus.png') }}" alt="Marcus Chen" class="avatar-img" onerror="this.style.display='none'">
                </div>
                <span class="status-dot away"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">Marcus Chen</span>
                    <span class="chat-time">1h ago</span>
                </div>
                <span class="chat-topic">Hydroponic pH levels...</span>
                <span class="chat-status await-label">Awaiting reply</span>
            </div>
        </div>

        <div class="chat-item" data-room="elena" onclick="switchRoom('elena')">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="ER" data-color="2">
                    <img src="{{ asset('image/avatar-elena.png') }}" alt="Elena Rodriguez" class="avatar-img" onerror="this.style.display='none'">
                </div>
                <span class="status-dot offline"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">Elena Rodriguez</span>
                    <span class="chat-time">Yesterday</span>
                </div>
                <span class="chat-topic">Vineyard pest control</span>
                <span class="chat-status offline-label">Offline</span>
            </div>
        </div>

        <div class="chat-item" data-room="james" onclick="switchRoom('james')">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="DJ" data-color="3">
                    <img src="{{ asset('image/avatar-james.png') }}" alt="Dr. James" class="avatar-img" onerror="this.style.display='none'">
                </div>
                <span class="status-dot online"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">Dr. James</span>
                    <span class="chat-time">3h ago</span>
                </div>
                <span class="chat-topic">Orchid root rot issue</span>
                <span class="chat-status active-label">Active</span>
            </div>
        </div>

        <div class="chat-item" data-room="emma" onclick="switchRoom('emma')">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="DE" data-color="4">
                    <img src="{{ asset('image/avatar-emma.png') }}" alt="Dr. Emma" class="avatar-img" onerror="this.style.display='none'">
                </div>
                <span class="status-dot online"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">Dr. Emma</span>
                    <span class="chat-time">5h ago</span>
                </div>
                <span class="chat-topic">Lavender propagation</span>
                <span class="chat-status active-label">Active</span>
            </div>
        </div>

    </div>
</div>

{{-- MAIN CHAT --}}
<div class="chat-main">

    <div class="chat-header">
        <div class="header-user">
            <div class="avatar-wrapper">
                <div class="avatar-shell avatar-shell--lg" data-initials="SJ" data-color="0" id="headerAvatarShell">
                    <img src="{{ asset('image/avatar-sarah.png') }}" alt="User" class="avatar-img" id="headerAvatarImg" onerror="this.style.display='none'">
                </div>
                <span class="status-dot online" id="headerStatusDot"></span>
            </div>
            <div class="header-info">
                <div class="header-name-row">
                    <span class="header-name" id="headerName">Sarah Johnson</span>
                    <span class="expert-tag" id="headerTag">TOMATO EXPERT</span>
                </div>
                <span class="header-sub" id="headerSub">
                    <span class="dot-green">●</span> Online • Tomato Plant Issue
                </span>
            </div>
        </div>
        <div class="header-actions">
            <button class="icon-btn" onclick="openMoreOptions()" title="More options">
                <svg class="icon-sm icon-muted" aria-hidden="true"><use href="#icon-more"/></svg>
            </button>
            <a href="#" class="end-chat-btn">
                <svg class="icon-sm icon-end" aria-hidden="true"><use href="#icon-x-circle"/></svg>
                End Chat
            </a>
        </div>
    </div>

    <div class="messages-container" id="messagesContainer">
        <div class="date-divider"><span>MONDAY, MAY 22</span></div>
        <div id="messagesList"></div>
    </div>

    <div class="input-area">
        <button class="input-icon-btn" onclick="openAttachment()" title="Attach file">
            <svg class="icon-md icon-muted" aria-hidden="true"><use href="#icon-plus-circle"/></svg>
        </button>
        <button class="input-icon-btn" onclick="openEmoji()" title="Emoji">
            <svg class="icon-md icon-muted" aria-hidden="true"><use href="#icon-smile"/></svg>
        </button>
        <input type="text" class="message-input" id="messageInput" placeholder="Type your advice...">
        <button class="send-btn" id="sendBtn" onclick="sendMessage()" title="Send">
            <svg class="icon-md icon-send-svg" aria-hidden="true"><use href="#icon-send"/></svg>
        </button>
    </div>

</div>

<script src="{{ asset('js/script-roomChatExpert.js') }}"></script>
</body>
</html>