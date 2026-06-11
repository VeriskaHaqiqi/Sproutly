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
@php
  $expert = $konsultasi->ahliBotani;
  $expertAvatar = $expert->user->profile_picture ? asset('storage/' . $expert->user->profile_picture) : ($expert->user->jenis_kelamin_user == 'P' ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=300&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80');
@endphp
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
        <img src="{{ $expertAvatar }}" alt="{{ $expert->nama_ahli }}" class="expert-avatar">
        <span class="status-dot ended"></span>
      </div>
      <div class="expert-info">
        <span class="expert-name">{{ $expert->nama_ahli }}</span>
        <span class="expert-tag">{{ $expert->spesialisasi ?? 'Expert Botanist' }}</span>
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
      <span>{{ $konsultasi->created_at->format('F d, Y') }} — Session Started</span>
    </div>

    <!-- Messages -->
    @foreach($konsultasi->pesan as $msg)
      @if($msg->pengirim === 'user')
        <div class="msg-row sent">
          <div class="msg-bubble">
            @if($msg->gambar)
              @if(preg_match('/\.(mp4|webm|ogg|mov)$/i', $msg->gambar))
                <video src="{{ asset('storage/' . $msg->gambar) }}" controls style="max-width: 100%; border-radius: 8px;"></video>
              @else
                <img src="{{ asset('storage/' . $msg->gambar) }}" alt="Image" style="max-width: 100%; border-radius: 8px;">
              @endif
            @endif
            @if($msg->isi_pesan)
              <p style="margin: 0;">{{ $msg->isi_pesan }}</p>
            @endif
            <span class="msg-time">{{ $msg->waktu_kirim->format('h:i A') }}</span>
          </div>
        </div>
      @else
        <div class="msg-row received">
          <img src="{{ $expertAvatar }}" class="msg-avatar" alt="{{ $expert->nama_ahli }}">
          <div class="msg-bubble">
            @if($msg->gambar)
              @if(preg_match('/\.(mp4|webm|ogg|mov)$/i', $msg->gambar))
                <video src="{{ asset('storage/' . $msg->gambar) }}" controls style="max-width: 100%; border-radius: 8px;"></video>
              @else
                <img src="{{ asset('storage/' . $msg->gambar) }}" alt="Image" style="max-width: 100%; border-radius: 8px;">
              @endif
            @endif
            @if($msg->isi_pesan)
              <p style="margin: 0;">{{ $msg->isi_pesan }}</p>
            @endif
            <span class="msg-time">{{ $msg->waktu_kirim->format('h:i A') }}</span>
          </div>
        </div>
      @endif
    @endforeach

    <!-- Session ended marker -->
    @if($konsultasi->tanggal_selesai)
      <div class="day-divider ended-divider">
        <span>Session ended — {{ \Carbon\Carbon::parse($konsultasi->tanggal_selesai)->format('F d, Y \a\t h:i A') }}</span>
      </div>
    @endif

  </div>

  <!-- SESSION ENDED BANNER + FEEDBACK FORM -->
  <div class="session-ended-bar" style="max-width: 600px; margin: 0 auto; width: 100%; padding: 10px;">
    <div class="ended-banner" style="display: flex; flex-direction: column; gap: 15px; padding: 20px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #eef2f6;">
      <div style="display: flex; align-items: center; gap: 12px;">
        <div class="ended-banner-icon" style="background: #fee2e2; color: #ef4444; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
          <svg viewBox="0 0 24 24" fill="none" width="20" height="20" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
          </svg>
        </div>
        <div class="ended-banner-text" style="display: flex; flex-direction: column; align-items: flex-start; text-align: left;">
          <strong style="color: #1e293b; font-size: 16px;">This session has ended.</strong>
          <span style="color: #64748b; font-size: 14px;">Leave a rating and review for your expert below.</span>
        </div>
      </div>

      <!-- REVIEW FORM -->
      <form action="{{ route('consultation.submitReview', ['id' => $konsultasi->id]) }}" method="POST" style="width: 100%;">
        @csrf
        <!-- Star Rating -->
        <div class="rating-stars" style="display: flex; gap: 8px; justify-content: center; margin: 15px 0;">
          @for ($i = 1; $i <= 5; $i++)
            <label style="cursor: pointer;">
              <input type="radio" name="rating" value="{{ $i }}" style="display: none;" required>
              <i class="fa-solid fa-star star-icon" data-value="{{ $i }}" style="font-size: 28px; color: #cbd5e1; transition: color 0.2s;"></i>
            </label>
          @endfor
        </div>

        <div style="margin-bottom: 15px;">
          <textarea name="comment" rows="3" placeholder="Describe your experience (optional)..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; font-family: inherit; font-size: 14px; resize: none; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#10b981'"></textarea>
        </div>

        <div style="display: flex; gap: 10px;">
          <button type="submit" class="submit-review-btn" style="flex: 1; background: #10b981; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">Submit Review</button>
          <a href="{{ url('/find-experts') }}" class="ended-restart-btn" style="flex: 1; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; text-align: center; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Start New Session</a>
        </div>
      </form>
    </div>
  </div>

</div>
<script>
  // Scroll chat to bottom on load
  const chatArea = document.getElementById("chatArea");
  if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;

  // Star rating interactivity
  const stars = document.querySelectorAll('.star-icon');
  const radios = document.querySelectorAll('input[name="rating"]');

  stars.forEach((star, index) => {
    star.addEventListener('click', () => {
      // Set radio button checked
      radios[index].checked = true;
      // Color selected stars and reset others
      stars.forEach((s, idx) => {
        if (idx <= index) {
          s.style.color = '#fbbf24'; // Gold star
        } else {
          s.style.color = '#cbd5e1'; // Gray star
        }
      });
    });

    star.addEventListener('mouseover', () => {
      // Highlights stars on hover
      stars.forEach((s, idx) => {
        if (idx <= index) {
          s.style.color = '#fde047'; // Light gold star
        }
      });
    });

    star.addEventListener('mouseout', () => {
      // Restores selected stars state
      let selectedIdx = -1;
      radios.forEach((r, idx) => {
        if (r.checked) selectedIdx = idx;
      });

      stars.forEach((s, idx) => {
        if (idx <= selectedIdx) {
          s.style.color = '#fbbf24';
        } else {
          s.style.color = '#cbd5e1';
        }
      });
    });
  });
</script>
</body>
</html>