<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Consultation History</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-endedRoomUser.css') }}">
</head>
<body>
<div class="room-page">

  <!-- TOPBAR -->
  <header class="room-topbar">
    <a href="{{ url('/consultationUser') }}" class="back-btn">
      <svg viewBox="0 0 24 24" fill="none">
        <path d="M19 12H5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M12 5L5 12L12 19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      Back
    </a>
    <div class="room-topbar-center">
      <div class="expert-avatar-wrap">
        <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" alt="Dewi Kusuma" class="expert-avatar">
        <span class="status-dot ended"></span>
      </div>
      <div class="expert-info">
        <span class="expert-name">Dewi Kusuma</span>
        <span class="expert-tag">Organic Farming</span>
      </div>
    </div>
    <div class="room-topbar-right">
      <span class="session-ended-pill">
        <svg viewBox="0 0 16 16" fill="none" width="13" height="13">
          <path d="M8 1.5C4.41 1.5 1.5 4.41 1.5 8C1.5 11.59 4.41 14.5 8 14.5C11.59 14.5 14.5 11.59 14.5 8C14.5 4.41 11.59 1.5 8 1.5ZM10.5 9.79L9.79 10.5L8 8.71L6.21 10.5L5.5 9.79L7.29 8L5.5 6.21L6.21 5.5L8 7.29L9.79 5.5L10.5 6.21L8.71 8L10.5 9.79Z" fill="currentColor"/>
        </svg>
        Session Ended
      </span>
    </div>
  </header>

  <!-- CHAT AREA -->
  <div class="chat-area" id="chatArea">

    <!-- Session start marker -->
    <div class="day-divider">
      <span>March 10, 2024 — Session Started</span>
    </div>

    <!-- Messages -->
    <div class="msg-row received">
      <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" class="msg-avatar" alt="Dewi">
      <div class="msg-bubble">
        Hello! I'm Dewi Kusuma, an organic farming specialist. How can I help you today?
        <span class="msg-time">09:00</span>
      </div>
    </div>

    <div class="msg-row sent">
      <div class="msg-bubble">
        Hi Dewi! I've been struggling with aphids on my chili plants. I'd like to avoid chemical pesticides.
        <span class="msg-time">09:02</span>
      </div>
    </div>

    <div class="msg-row received">
      <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" class="msg-avatar" alt="Dewi">
      <div class="msg-bubble">
        Great choice going organic! For aphids on chili, I recommend a neem oil spray. Mix 2 tsp neem oil with 1 tsp dish soap in 1 litre of water. Spray in the early morning or evening.
        <span class="msg-time">09:05</span>
      </div>
    </div>

    <div class="msg-row sent">
      <div class="msg-bubble">
        That sounds manageable. How often should I apply it?
        <span class="msg-time">09:07</span>
      </div>
    </div>

    <div class="msg-row received">
      <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" class="msg-avatar" alt="Dewi">
      <div class="msg-bubble">
        Apply every 5–7 days for 3 weeks. If the infestation is heavy, you can also introduce ladybugs — they're natural predators of aphids and very effective in open garden setups.
        <span class="msg-time">09:10</span>
      </div>
    </div>

    <div class="msg-row sent">
      <div class="msg-bubble">
        Perfect. Also, should I remove the heavily infested leaves first?
        <span class="msg-time">09:12</span>
      </div>
    </div>

    <div class="msg-row received">
      <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" class="msg-avatar" alt="Dewi">
      <div class="msg-bubble">
        Yes, definitely. Prune any leaves with heavy aphid colonies first, then apply the neem oil spray to the rest. This makes the treatment much more effective.
        <span class="msg-time">09:15</span>
      </div>
    </div>

    <div class="msg-row sent">
      <div class="msg-bubble">
        Thank you so much! Your organic compost plan also looked really solid.
        <span class="msg-time">09:18</span>
      </div>
    </div>

    <div class="msg-row received">
      <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80" class="msg-avatar" alt="Dewi">
      <div class="msg-bubble">
        Great, your organic compost plan looks solid. Keep it up! Feel free to reach out again if you need follow-up advice.
        <span class="msg-time">09:20</span>
      </div>
    </div>

    <!-- Session ended marker -->
    <div class="day-divider ended-divider">
      <span>Session ended — March 10, 2024 at 09:22</span>
    </div>

  </div>

  <!-- SESSION ENDED BANNER + DISABLED INPUT -->
  <div class="session-ended-bar">
    <div class="ended-banner">
      <div class="ended-banner-icon">
        <svg viewBox="0 0 24 24" fill="none" width="20" height="20">
          <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="currentColor"/>
        </svg>
      </div>
      <div class="ended-banner-text">
        <strong>This session has ended.</strong>
        <span>To continue consulting with this expert, please start a new session.</span>
      </div>
      <a href="{{ url('/find-experts') }}" class="ended-restart-btn">
        Start New Session
      </a>
    </div>

    <!-- Input bar — disabled -->
    <div class="chat-input-row disabled">
      <button class="input-attach" disabled>
        <i class="fa-solid fa-paperclip"></i>
      </button>
      <div class="input-field">
        <input type="text" placeholder="Session has ended — start a new session to chat" disabled/>
      </div>
      <button class="input-send" disabled>
        <svg viewBox="0 0 24 24" fill="none" width="18" height="18">
          <path d="M22 2L11 13" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </div>

</div>
<script>
  // Scroll chat to bottom on load
  const chatArea = document.getElementById("chatArea");
  if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;
</script>
</body>
</html>