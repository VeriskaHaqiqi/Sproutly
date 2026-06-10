<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info - Plant Expert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-userInfo.css') }}">
</head>
<body>

    <div class="page-wrapper">

        <!-- Header -->
        <div class="header">
            <a href="/roomChatExpert">
                <button class="back-btn" onclick="goBack()">
                    <img src="{{ asset('images/arrowLeft.png') }}" alt="Back" class="icon-sm">
                </button>
            </a>
            <span class="header-title">Client Info</span>
            <div class="header-spacer"></div>
        </div>

        <!-- Profile Card -->
        <div class="profile-section">
            <div class="avatar-wrapper">
                <div class="avatar">
                    <span class="avatar-initials" id="avatarInitials">SJ</span>
                </div>
                <div class="online-badge"></div>
            </div>
            <h2 class="client-name" id="clientName">Sarah Johnson</h2>
        </div>

        <!-- Info Cards -->
        <div class="info-container">

            <div class="info-card">
                <div class="info-icon-wrap" style="background: #ffff9f;">
                    <img src="{{ asset('images/user.png') }}" alt="Name" class="icon-md">
                </div>
                <div class="info-content">
                    <span class="info-label">Full Name</span>
                    <span class="info-value" id="infoName">Sarah Johnson</span>
                </div>
                <button class="copy-btn" onclick="copyText('infoName')" title="Copy">
                    <img src="{{ asset('images/copy.png') }}" alt="Copy" class="icon-sm">
                </button>
            </div>

            <div class="info-card">
                <div class="info-icon-wrap" style="background: #d0ff99;">
                    <img src="{{ asset('images/phone.png') }}" alt="Phone" class="icon-md">
                </div>
                <div class="info-content">
                    <span class="info-label">Phone Number</span>
                    <span class="info-value" id="infoPhone">+62 812-3456-7890</span>
                </div>
                <button class="copy-btn" onclick="copyText('infoPhone')" title="Copy">
                    <img src="{{ asset('images/copy.png') }}" alt="Copy" class="icon-sm">
                </button>
            </div>

            <div class="info-card">
                <div class="info-icon-wrap" style="background: #99ff99;">
                    <img src="{{ asset('images/email.png') }}" alt="Email" class="icon-md">
                </div>
                <div class="info-content">
                    <span class="info-label">Email Address</span>
                    <span class="info-value" id="infoEmail">sarah.johnson@email.com</span>
                </div>
                <button class="copy-btn" onclick="copyText('infoEmail')" title="Copy">
                    <img src="{{ asset('images/copy.png') }}" alt="Copy" class="icon-sm">
                </button>
            </div>

        </div>

        <!-- Session Info -->
        <div class="session-card">
            <div class="session-row">
                <img src="{{ asset('images/clock.png') }}" alt="Time" class="icon-sm">
                <span class="session-text">Session started · Today, 10:12 AM</span>
            </div>
        </div>

        <!-- Close Button -->
        <div class="footer-action">
            <a href="{{ url('/roomChatExpert') }}">
                <button class="close-btn" onclick="goBack()">
                    <img src="{{ asset('images/close.png') }}" alt="Close" class="icon-sm">
                    Close & Return to Chat
                </button>
            </a>
        </div>

    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <img src="{{ asset('images/check.png') }}" alt="ok" class="icon-sm">
        Copied to clipboard!
    </div>

    <script src="{{ asset('js/script-userInfo.js') }}"></script>
</body>
</html>