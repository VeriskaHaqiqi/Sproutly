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
                <button class="close-btn" disabled aria-label="Close">✕</button>
            </div>
        </header>

        @php
            $avatar = $expert->user->profile_picture ? asset('storage/' . $expert->user->profile_picture) : ($expert->user->jenis_kelamin_user == 'P' ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
            $fee = $expert->active_tarif ?? 45000;
            $feeFormatted = 'Rp' . number_format($fee, 0, ',', '.');
            $rating = 4.8;
            if ($expert->ratings()->exists()) {
                $rating = round($expert->ratings()->avg('nilai'), 1);
            }
        @endphp
        {{-- Doctor Info Bar --}}
        <div class="doctor-bar">
            <div class="doctor-info">
                <div class="doctor-avatar">
                    <img src="{{ $avatar }}" alt="{{ $expert->nama_ahli }}"
                         onerror="this.style.display='none'; this.parentElement.innerHTML='EX'; this.parentElement.classList.add('doctor-avatar-fallback');">
                </div>
                <div class="doctor-details">
                    <div class="doctor-name-row">
                        <h2 class="doctor-name">{{ $expert->nama_ahli }}</h2>
                        <span class="doctor-badge">{{ strtoupper($expert->spesialisasi ?? 'Expert Botanist') }}</span>
                    </div>
                    <div class="doctor-meta">
                        <span class="doctor-rating">★ {{ $rating }}</span>
                        <span class="doctor-sep">•</span>
                        <span class="doctor-exp">{{ $expert->pengalaman_tahun ?? 5 }} years experience</span>
                    </div>
                </div>
            </div>
            <button class="view-profile-btn" onclick="window.location.href='/infoahli?id={{ $expert->id }}'">View Profile</button>
        </div>

        {{-- Chat Area --}}
        <div class="chat-area">

            {{-- Background chat messages (non-interactive) --}}
            <div class="chat-messages" aria-hidden="true">
                <div class="message received">
                    <div class="msg-avatar">
                        <img src="{{ $avatar }}" alt="{{ $expert->nama_ahli }}"
                             onerror="this.style.display='none';">
                    </div>
                    <div class="msg-bubble">
                        Hello! I'm {{ $expert->nama_ahli }}. I see you're having some trouble with your plants. Can you tell me a bit more about the plant conditions?
                    </div>
                </div>

                <div class="message sent">
                    <div class="msg-bubble">
                        The leaves look a bit pale and the roots are turning grey.
                    </div>
                    <div class="msg-avatar user-avatar-sm"></div>
                </div>

                <div class="message received">
                    <div class="msg-avatar">
                        <img src="{{ $avatar }}" alt="{{ $expert->nama_ahli }}"
                             onerror="this.style.display='none';">
                    </div>
                    <div class="msg-bubble">
                        Could you please upload a photo of the leaves/roots so I can take a better look?
                    </div>
                </div>

                <div class="message sent">
                    <div class="msg-bubble">
                        Sure, let me take a photo right now!
                    </div>
                    <div class="msg-avatar user-avatar-sm"></div>
                </div>

                <div class="message received">
                    <div class="msg-avatar">
                        <img src="{{ $avatar }}" alt="{{ $expert->nama_ahli }}"
                             onerror="this.style.display='none';">
                    </div>
                    <div class="msg-bubble">
                        Great! Once I see the photo I can give you a proper diagnosis and care plan.
                    </div>
                </div>
            </div>

            {{-- Blur + Dark Overlay --}}
            <div class="lock-overlay">

                {{-- Payment Card (not blurred) --}}
                <div class="payment-card">

                    <div class="lock-icon-wrap">
                        <img src="{{ asset('image/lock.png') }}" alt="Lock">
                    </div>

                    <h3 class="payment-title">Expert Consultation</h3>

                    <p class="payment-desc">
                        Get personalized plant care advice and diagnosis directly from {{ $expert->nama_ahli }}.
                    </p>

                    <div class="price-box">
                        <div class="price-info">
                            <span class="price-amount">{{ $feeFormatted }}</span>
                            <span class="price-label">One-time payment</span>
                        </div>
                        <div class="price-shield">🛡️</div>
                    </div>

                    <a href="/consultation/book/{{ $expert->id }}" class="pay-btn" id="payBtn">
                        Pay Now &amp; Unlock Chat
                        <span class="btn-arrow">→</span>
                    </a>

                    <a href="/find-experts" class="cancel-btn" id="cancelBtn">
                        Cancel
                    </a>

                    <div class="payment-footer">
                        <span class="payment-footer-text">
                            Secure payment • Continue chatting after payment
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input Bar (display only, all disabled) --}}
        <div class="chat-input-bar locked">
            <button class="input-attach" disabled aria-label="Attach file">📎</button>
            <input
                type="text"
                class="chat-input"
                placeholder="Unlock consultation to start chatting"
                disabled
                aria-label="Chat input"
            >
            <button class="input-lock-icon" disabled aria-label="Locked">🔒</button>
            <button class="input-send" disabled aria-label="Send message">➤</button>
        </div>

    </main>

    <script src="{{ asset('js/script-lockRoomUser.js') }}"></script>
</body>
</html>