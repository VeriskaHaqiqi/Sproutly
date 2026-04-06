{{-- resources/views/user/consultation-chat.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Chat – Sproutly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style-lockRoomUser.css') }}">
</head>
<body>

    <main class="main-content">

        {{-- Top Bar --}}
        <header class="topbar">
            <h1 class="topbar-title">CONSULTATION CHAT</h1>

            <div class="topbar-actions">
                <a href="/consultationUser" class="close-btn" aria-label="Close consultation">✕</a>
            </div>
        </header>

        {{-- Doctor Info Bar --}}
        <div class="doctor-bar">
            <div class="doctor-info">
                <div class="doctor-avatar">
                    <img src="{{ asset('image/doctor-sarah.png') }}" alt="Dr. Sarah Chen" onerror="this.style.display='none'; this.parentElement.innerHTML='SC'; this.parentElement.classList.add('doctor-avatar-fallback');">
                </div>

                <div class="doctor-details">
                    <div class="doctor-name-row">
                        <h2 class="doctor-name">Dr. Sarah Chen</h2>
                        <span class="doctor-badge">ORCHID SPECIALIST</span>
                    </div>

                    <div class="doctor-meta">
                        <span class="doctor-rating">★ 4.9</span>
                        <span class="doctor-sep">•</span>
                        <span class="doctor-exp">8 years experience</span>
                    </div>
                </div>
            </div>

            <a href="/infoahli" class="view-profile-btn">View Profile</a>
        </div>

        {{-- Chat Area --}}
        <div class="chat-area">

            {{-- Hidden/locked chat preview --}}
            <div class="chat-messages blurred" aria-hidden="true">
                <div class="message received">
                    <div class="msg-avatar">
                        <img src="{{ asset('image/doctor-sarah.png') }}" alt="Dr. Sarah" onerror="this.style.display='none';">
                    </div>
                    <div class="msg-bubble">
                        Hello! I'm Dr. Chen. I see you're having some trouble with your Phalaenopsis orchid. Can you tell me a bit more about the light conditions?
                    </div>
                </div>

                <div class="message sent">
                    <div class="msg-bubble">
                        The plant is near a north-facing window. The leaves look a bit pale and the roots are turning grey.
                    </div>
                    <div class="msg-avatar user-avatar-sm">
                        <img src="{{ asset('image/user-avatar.png') }}" alt="User" onerror="this.style.display='none';">
                    </div>
                </div>

                <div class="message received">
                    <div class="msg-avatar">
                        <img src="{{ asset('image/doctor-sarah.png') }}" alt="Dr. Sarah" onerror="this.style.display='none';">
                    </div>
                    <div class="msg-bubble">
                        Dark green leaves often suggest it's not getting enough light. Could you please upload a photo of the roots so I can take a better look?
                    </div>
                </div>
            </div>

            {{-- Solid Lock Overlay --}}
            <div class="lock-overlay">
                <div class="payment-card">

                    <div class="lock-icon-wrap">
                        <img src="{{ asset('image/lock.png') }}" alt="Locked" class="lock-icon" onerror="this.outerHTML='<span class=\'lock-emoji\'>🔒</span>';">
                    </div>

                    <h3 class="payment-title">Expert Consultation</h3>

                    <p class="payment-desc">
                        Get personalized plant care advice and diagnosis directly from Dr. Sarah Chen.
                    </p>

                    <div class="price-box">
                        <div class="price-info">
                            <span class="price-amount">Rp45.000</span>
                            <span class="price-label">One-time payment</span>
                        </div>

                        <div class="price-shield">
                            <img src="{{ asset('image/shield.png') }}" alt="Secure" onerror="this.outerHTML='<span>🛡️</span>';">
                        </div>
                    </div>

                    <a href="/paymentUser" class="pay-btn" id="payBtn">
                        Pay Now &amp; Unlock Chat
                        <span class="btn-arrow">→</span>
                    </a>

                    <div class="payment-footer">
                        <span class="payment-footer-text">
                            Secure payment • Continue chatting after payment
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input Bar --}}
        <div class="chat-input-bar locked">
            <button class="input-attach" disabled aria-label="Attach file">📎</button>

            <input
                type="text"
                class="chat-input"
                placeholder="Unlock consultation to start chatting"
                disabled
                aria-label="Chat input"
            >

            <button class="input-lock-icon" disabled aria-label="Locked">
                <img src="{{ asset('images/lock icon.png') }}" alt="Locked"
            </button>
            <button class="input-send" disabled aria-label="Send message">➤</button>
        </div>

    </main>

    <script src="{{ asset('js/script-lockRoomUser.js') }}"></script>
</body>
</html>