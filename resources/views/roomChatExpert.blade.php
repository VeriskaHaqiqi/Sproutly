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
    <symbol id="icon-send" viewBox="0 0 24 24" fill="currentColor">
        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
    </symbol>
</svg>

{{-- END CHAT MODAL --}}
<div class="modal-overlay" id="endChatModal">
    <div class="modal-box">
        <div class="modal-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="15" y1="9" x2="9" y2="15"/>
                <line x1="9" y1="9" x2="15" y2="15"/>
            </svg>
        </div>
        <h3 class="modal-title">End Consultation?</h3>
        <p class="modal-desc">This will end the session. Both you and the client will no longer be able to send messages, but the chat history will remain visible.</p>
        <div class="modal-actions">
            <button class="modal-btn modal-btn--cancel" onclick="closeEndChatModal()">Cancel</button>
            <button class="modal-btn modal-btn--confirm" onclick="confirmEndChat()">End Chat</button>
        </div>
    </div>
</div>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-header">
        <a href="/consulexpert" class="back-btn">
            <svg class="icon-sm" aria-hidden="true"><use href="#icon-arrow-left"/></svg>
            <span>Back to Consultation</span>
        </a>
    </div>

    <div class="search-bar">
        <svg class="icon-search-svg" aria-hidden="true"><use href="#icon-search"/></svg>
        <input type="text" placeholder="Search consultations..." id="searchInput">
    </div>

    <div class="sidebar-section">
        <span class="section-label">RECENT CHATS</span>
        <span class="active-badge">{{ $consultations->count() }} ACTIVE</span>
    </div>

    <div class="chat-list" id="chatList">
        @forelse($consultations as $konsul)
        <div class="chat-item {{ isset($activeConsultation) && $activeConsultation->id == $konsul->id ? 'active' : '' }}" 
             data-room="db-{{ $konsul->id }}" 
             data-consultation-id="{{ $konsul->id }}"
             onclick="window.location.href='/roomChatExpert?id={{ $konsul->id }}'">
            <div class="avatar-wrapper">
                <div class="avatar-shell" data-initials="{{ strtoupper(substr($konsul->user->nama_user, 0, 2)) }}" data-color="{{ $loop->index % 5 }}">
                    @if($konsul->user->profile_picture)
                    <img src="{{ asset('storage/' . $konsul->user->profile_picture) }}" alt="{{ $konsul->user->nama_user }}" class="avatar-img" onerror="this.style.display='none'">
                    @endif
                </div>
                <span class="status-dot online"></span>
            </div>
            <div class="chat-info">
                <div class="chat-meta">
                    <span class="chat-name">{{ $konsul->user->nama_user }}</span>
                    <span class="chat-time">{{ $konsul->created_at->diffForHumans() }}</span>
                </div>
                <span class="chat-topic">{{ $konsul->topik ?? 'Plant Consultation' }}</span>
                <span class="chat-status active-label">Active</span>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:40px 16px;color:#94a3b8;font-size:13px;">
            No active consultations
        </div>
        @endforelse
    </div>
</div>

{{-- MAIN CHAT --}}
<div class="chat-main">

    @if($activeConsultation)
    {{-- CHAT HEADER --}}
    <div class="chat-header">
        <div class="header-user">
            <a href="{{ url('/userInfo') }}" class="header-user">
                <div class="avatar-wrapper">
                    <div class="avatar-shell avatar-shell--lg" data-initials="{{ strtoupper(substr($activeConsultation->user->nama_user, 0, 2)) }}" data-color="0" id="headerAvatarShell">
                        @if($activeConsultation->user->profile_picture)
                        <img src="{{ asset('storage/' . $activeConsultation->user->profile_picture) }}" alt="{{ $activeConsultation->user->nama_user }}" class="avatar-img" id="headerAvatarImg" onerror="this.style.display='none'">
                        @endif
                    </div>
                    <span class="status-dot online" id="headerStatusDot"></span>
                </div>
                <div class="header-info">
                    <div class="header-name-row">
                        <span class="header-name" id="headerName">{{ $activeConsultation->user->nama_user }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="header-actions">
            <button class="icon-btn" onclick="openMoreOptions()" title="More options">
                <svg class="icon-sm icon-muted" aria-hidden="true"><use href="#icon-more"/></svg>
            </button>
            <button class="end-chat-btn" id="endChatBtn" onclick="openEndChatModal()">
                <svg class="icon-sm icon-end" aria-hidden="true"><use href="#icon-x-circle"/></svg>
                End Chat
            </button>
        </div>
    </div>

    {{-- ENDED BANNER (hidden by default) --}}
    <div class="ended-banner" id="endedBanner" style="display:none">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
        </svg>
        Consultation session has ended. No new messages can be sent.
    </div>

    {{-- MESSAGES --}}
    <div class="messages-container" id="messagesContainer">
        <div class="date-divider" id="dateDivider">
            <span id="dateDividerText"></span>
        </div>
        <div id="messagesList"></div>
    </div>

    {{-- MEDIA PREVIEW BAR (shown when file selected) --}}
    <div class="media-preview-bar" id="mediaPreviewBar" style="display:none">
        <div class="media-preview-inner">
            <div class="media-thumb-wrap" id="mediaThumbWrap">
                {{-- thumbnail injected by JS --}}
            </div>
            <div class="media-preview-info">
                <span class="media-filename" id="mediaFilename">photo.jpg</span>
                <span class="media-filesize" id="mediaFilesize">—</span>
            </div>
            <button class="media-remove-btn" onclick="removeMedia()" title="Remove">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Hidden file inputs --}}
    <input type="file" id="fileInputPhoto" accept="image/*" style="display:none" onchange="handleFileSelect(this)">
    <input type="file" id="fileInputVideo" accept="video/*" style="display:none" onchange="handleFileSelect(this)">

    {{-- INPUT AREA --}}
    <div class="input-area" id="inputArea">

        {{-- Attachment popup trigger --}}
        <div class="attach-wrap" id="attachWrap">
            <button class="input-icon-btn" onclick="toggleAttachMenu()" title="Attach file" id="attachBtn">
                <svg class="icon-md icon-muted" aria-hidden="true"><use href="#icon-plus-circle"/></svg>
            </button>

            {{-- Attach dropdown menu --}}
            <div class="attach-menu" id="attachMenu">
                <button class="attach-option" onclick="pickPhoto()">
                    <span class="attach-option-icon photo-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </span>
                    <span>Photo</span>
                </button>
                <button class="attach-option" onclick="pickVideo()">
                    <span class="attach-option-icon video-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>
                        </svg>
                    </span>
                    <span>Video</span>
                </button>
            </div>
        </div>

        <button class="input-icon-btn" onclick="openEmoji()" title="Emoji" id="emojiBtn">
            <svg class="icon-md icon-muted" aria-hidden="true"><use href="#icon-smile"/></svg>
        </button>
        <input type="text" class="message-input" id="messageInput" placeholder="Type your advice...">
        <button class="send-btn" id="sendBtn" onclick="sendMessage()" title="Send">
            <svg class="icon-md icon-send-svg" aria-hidden="true"><use href="#icon-send"/></svg>
        </button>
    </div>

    @else
    {{-- NO ACTIVE CONSULTATION --}}
    <div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;color:#94a3b8;gap:12px;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        <p style="font-size:16px;font-weight:500;">Select a consultation to start chatting</p>
    </div>
    @endif

</div>

<script>
    window.ACTIVE_CONSULTATION = {!! json_encode($activeConsultation ? [
        'id' => $activeConsultation->id,
        'user_name' => $activeConsultation->user->nama_user,
        'user_initials' => strtoupper(substr($activeConsultation->user->nama_user, 0, 2)),
        'user_avatar' => $activeConsultation->user->profile_picture ? asset('storage/' . $activeConsultation->user->profile_picture) : null,
        'topik' => $activeConsultation->topik ?? 'Plant Consultation',
        'status' => $activeConsultation->status_konsultasi,
    ] : null) !!};

    window.INITIAL_MESSAGES = {!! json_encode($messages->map(function($m) {
        return [
            'id' => $m->id,
            'pengirim' => $m->pengirim,
            'isi_pesan' => $m->isi_pesan,
            'gambar' => $m->gambar ? asset('storage/' . $m->gambar) : null,
            'waktu_kirim' => $m->waktu_kirim->format('g:i A'),
        ];
    })) !!};

    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script-roomChatExpert.js') }}"></script>
</body>
</html>