<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sproutly - Consultation Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-paymentVerified.css') }}">
</head>
<body>

{{-- Main App Layout --}}
<div class="app-layout">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar">
        {{-- Logo --}}
        <div class="sidebar-logo">
            <div class="logo-icon">
                <img src="{{ asset('image/logo.png') }}" alt="Sproutly Logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <span class="logo-fallback" style="display:none;">🌱</span>
            </div>
            <span class="logo-text">Sproutly</span>
        </div>

        {{-- Search --}}
        <div class="sidebar-search">
            <div class="search-wrapper">
                <img src="{{ asset('image/search.png') }}" alt="Search" class="search-icon" onerror="this.outerHTML='<svg class=\'search-icon\' viewBox=\'0 0 20 20\' fill=\'none\'><circle cx=\'8\' cy=\'8\' r=\'5\' stroke=\'#aaa\' stroke-width=\'1.5\'/><path d=\'m13 13 3 3\' stroke=\'#aaa\' stroke-width=\'1.5\' stroke-linecap=\'round\'/></svg>'">
                <input type="text" placeholder="Search consultations..." class="search-input">
            </div>
        </div>

        {{-- Recent Chats Header --}}
        <div class="chats-header">
            <span class="chats-label">RECENT CHATS</span>
            <span class="active-badge">3 ACTIVE</span>
        </div>

        {{-- Chat List --}}
        <div class="chat-list">
            {{-- Chat Item 1 - Active --}}
            <div class="chat-item active" id="chat-sarah">
                <div class="chat-avatar">
                    <img src="{{ asset('image/sarah.png') }}" alt="Sarah Johnson" onerror="this.src='https://ui-avatars.com/api/?name=Sarah+Johnson&background=d0ff99&color=333&size=40'">
                    <span class="status-dot online"></span>
                </div>
                <div class="chat-info">
                    <div class="chat-name-row">
                        <span class="chat-name">Sarah Johnson</span>
                        <span class="chat-time">2m ago</span>
                    </div>
                    <span class="chat-topic">Tomato Plant Issue</span>
                    <span class="chat-status active-status">Active</span>
                </div>
            </div>

            {{-- Chat Item 2 --}}
            <div class="chat-item" id="chat-marcus">
                <div class="chat-avatar">
                    <img src="{{ asset('image/marcus.png') }}" alt="Marcus Chen" onerror="this.src='https://ui-avatars.com/api/?name=Marcus+Chen&background=76ead0&color=333&size=40'">
                    <span class="status-dot away"></span>
                </div>
                <div class="chat-info">
                    <div class="chat-name-row">
                        <span class="chat-name">Marcus Chen</span>
                        <span class="chat-time">1h ago</span>
                    </div>
                    <span class="chat-topic">Hydroponic pH levels...</span>
                    <span class="chat-status awaiting-status">Awaiting reply</span>
                </div>
            </div>

            {{-- Chat Item 3 --}}
            <div class="chat-item" id="chat-elena">
                <div class="chat-avatar">
                    <img src="{{ asset('image/elena.png') }}" alt="Elena Rodriguez" onerror="this.src='https://ui-avatars.com/api/?name=Elena+Rodriguez&background=ffff9f&color=333&size=40'">
                    <span class="status-dot offline"></span>
                </div>
                <div class="chat-info">
                    <div class="chat-name-row">
                        <span class="chat-name">Elena Rodriguez</span>
                        <span class="chat-time">Yesterday</span>
                    </div>
                    <span class="chat-topic">Vineyard pest control</span>
                    <span class="chat-status offline-status">Offline</span>
                </div>
            </div>
        </div>

        {{-- Start New Consultation Button --}}
        <div class="sidebar-footer">
            <button class="btn-new-consultation">
                <img src="{{ asset('image/plus.png') }}" alt="Plus" class="btn-icon" onerror="this.outerHTML='<span class=\'btn-icon\'>+</span>'">
                Start New Consultation
            </button>
        </div>
    </aside>

    {{-- ===== MAIN CHAT AREA ===== --}}
    <main class="chat-area">
        {{-- Chat Header --}}
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="header-avatar">
                    <img src="{{ asset('image/sarah.png') }}" alt="Sarah Johnson" onerror="this.src='https://ui-avatars.com/api/?name=Sarah+Johnson&background=d0ff99&color=333&size=44'">
                    <span class="status-dot online"></span>
                </div>
                <div class="header-info">
                    <div class="header-name-row">
                        <span class="header-name">Sarah Johnson</span>
                        <span class="expert-badge">TOMATO EXPERT</span>
                    </div>
                    <span class="header-status">
                        <span class="online-dot"></span>
                        Online • Tomato Plant Issue
                    </span>
                </div>
            </div>
            <div class="chat-header-right">
                <button class="btn-more">
                    <img src="{{ asset('image/more.png') }}" alt="More" onerror="this.outerHTML='<span>⋮</span>'">
                </button>
                <button class="btn-end-chat">
                    <img src="{{ asset('image/close-circle.png') }}" alt="End" class="end-icon" onerror="this.outerHTML='<span>✕</span>'">
                    End Chat
                </button>
            </div>
        </div>

        {{-- Chat Messages Area --}}
        <div class="chat-messages" id="chatMessages">
            <div class="date-divider">
                <span>MONDAY, MAY 22</span>
            </div>
        </div>

        {{-- Chat Input --}}
        <div class="chat-input-area">
            <button class="input-btn">
                <img src="{{ asset('image/attach.png') }}" alt="Attach" onerror="this.outerHTML='<span>+</span>'">
            </button>
            <button class="input-btn">
                <img src="{{ asset('image/emoji.png') }}" alt="Emoji" onerror="this.outerHTML='<span>😊</span>'">
            </button>
            <div class="input-wrapper">
                <input type="text" id="messageInput" placeholder="Type your advice..." class="message-input">
            </div>
            <button class="btn-send" id="btnSend">
                <img src="{{ asset('image/send.png') }}" alt="Send" onerror="this.outerHTML='<svg viewBox=\'0 0 24 24\' fill=\'white\' width=\'18\' height=\'18\'><path d=\'M2 21L23 12 2 3v7l15 2-15 2v7z\'/></svg>'">
            </button>
        </div>
    </main>
</div>

{{-- ===== PAYMENT VERIFIED MODAL ===== --}}
<div class="modal-overlay" id="paymentModal">
    <div class="modal-card" id="modalCard">

        {{-- Success Icon --}}
        <div class="modal-icon-wrapper">
            <div class="modal-icon-bg">
                <div class="modal-icon-inner">
                    <img src="{{ asset('image/check.png') }}" alt="Verified" class="check-icon" onerror="this.outerHTML='<svg viewBox=\'0 0 24 24\' fill=\'none\' width=\'28\' height=\'28\'><path d=\'M5 13l4 4L19 7\' stroke=\'white\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/></svg>'">
                </div>
            </div>
        </div>

        {{-- Modal Title --}}
        <h2 class="modal-title">Payment Verified</h2>
        <p class="modal-desc">The user's payment has been successfully verified. You can now begin the consultation session.</p>

        {{-- Client Info Card --}}
        <div class="client-info-card">
            <div class="client-info-col">
                <span class="info-label">CLIENT NAME</span>
                <span class="info-value">{{ $clientName ?? 'Sarah Johnson' }}</span>
            </div>
            <div class="divider-vertical"></div>
            <div class="client-info-col">
                <span class="info-label">PAYMENT STATUS</span>
                <div class="status-verified">
                    <span class="verified-dot"></span>
                    <span class="verified-text">Verified</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="modal-actions">
            <button class="btn-start" id="btnStartConsultation"
                data-session-id="{{ $sessionId ?? 'sess_001' }}"
                data-client-name="{{ $clientName ?? 'Sarah Johnson' }}">
                Start Consultation
            </button>
            <button class="btn-close" id="btnClose">
                Close
            </button>
        </div>

    </div>
</div>

{{-- Toast Notification --}}
<div class="toast" id="toast"></div>

{{-- Inject Laravel routes ke JS --}}
<script>
    window.ROUTES = {
        roomChatExpert: "/roomChatExpert"
    };
</script>
<script src="{{ asset('js/script-paymentVerified.js') }}"></script>
</body>
</html>