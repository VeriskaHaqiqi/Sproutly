<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Password - Sproutly</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style-inputPassword.css') }}">
</head>
<body>
    <div class="page-wrapper">
        <!-- LEFT SIDE -->
        <div class="left-panel">
            <!-- dekorasi background -->
            <div class="shape circle circle-1"></div>
            <div class="shape circle circle-2"></div>
            <div class="shape circle circle-3"></div>
            <div class="shape circle circle-4"></div>
            <div class="shape capsule"></div>
            <div class="shape quarter-circle"></div>

            <!-- icon kecil atas -->
            <div class="mini-icons">
                <div class="mini-box">
                    <span>🌱</span>
                </div>
                <div class="mini-box">
                    <span>🍃</span>
                </div>
                <div class="mini-box">
                    <span>🪴</span>
                </div>
                <div class="leaf-big">🍃</div>
            </div>

            <div class="left-content">
                <h1>
                    Reset Your <br>
                    <span>Password</span>
                </h1>

                <p>
                    Create a new secure password to continue your
                    journey with Sproutly.
                </p>
            </div>

        
        </div>

        <!-- RIGHT SIDE -->
        <div class="right-panel">
            <div class="form-card">
                <!-- LOGO -->
                <div class="brand">
                    <div class="brand-logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="brand-logo">
                    </div>
                    <span class="brand-text">Sproutly</span>
                </div>

                <h2>Create New Password</h2>
                <p class="subtitle">
                    Your new password must be different from your
                    previous password.
                </p>

                <form id="resetPasswordForm">
                    <label for="newPassword">New Password</label>
                    <div class="input-group">
                        <input type="password" id="newPassword" placeholder="Enter new password">
                        <button type="button" class="toggle-password" data-target="newPassword">
                            <span>👁</span>
                        </button>
                    </div>

                    <label for="confirmPassword">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" id="confirmPassword" placeholder="Re-enter new password">
                        <button type="button" class="toggle-password" data-target="confirmPassword">
                            <span>👁</span>
                        </button>
                    </div>

                    <div class="password-rules">
                        <div class="rule valid" id="rule-length">
                            <span class="dot">✔</span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="rule" id="rule-case">
                            <span class="dot">●</span>
                            <span>Include uppercase and lowercase letters</span>
                        </div>
                        <div class="rule" id="rule-number">
                            <span class="dot">●</span>
                            <span>Include at least one number</span>
                        </div>
                    </div>

                    <!-- TOMBOL -->
                    <button type="submit" class="save-btn">
                        Save New Password
                    </button>

                    <!-- TOMBOL PINDAH HALAMAN -->
                    <a href="{{ route('login') }}" class="back-login">
                        ← Back to Login
                    </a>
                </form>
            </div>
        </div>
    </div>
        <!-- POPUP PASSWORD UPDATED -->
    <div class="success-modal-overlay" id="successModal">
        <div class="success-modal">
            <button type="button" class="close-modal" id="closeModalBtn">×</button>

            <div class="success-icon-wrap">
                <div class="success-icon-circle">
                    <div class="success-icon-check">✓</div>
                </div>
            </div>

            <h3>Password Successfully <br>Updated</h3>

            <p>
                Your new password has been successfully
                created. You can now log in to your account and
                continue where you left off.
            </p>

            <a href="{{ route('login') }}" class="modal-login-btn">
                Back to Login
            </a>

            <div class="modal-help-text">
                Need help? <a href="#">Contact support</a>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('js/inputPassword.js') }}"></script>

</body>
</html>