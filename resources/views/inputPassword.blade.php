<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Password - Sproutly</title>

    <link rel="stylesheet" href="{{ asset('css/style-inputPassword.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-wrapper">
        <!-- LEFT PANEL -->
        <section class="left-panel">
            <div class="shape circle circle-1"></div>
            <div class="shape circle circle-2"></div>
            <div class="shape circle circle-3"></div>
            <div class="shape circle circle-4"></div>
            <div class="shape capsule"></div>
            <div class="shape quarter-circle"></div>

            <div class="mini-icons">
                <div class="mini-box">🌱</div>
                <div class="mini-box">🍃</div>
                <div class="mini-box">🪴</div>
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
        </section>

        <!-- RIGHT PANEL -->
        <section class="right-panel">
            <div class="form-card">
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

                <form id="resetPasswordForm" novalidate>
                    <div class="field-group">
                        <label for="newPassword">New Password</label>
                        <div class="input-group">
                            <input type="password" id="newPassword" placeholder="Enter new password">
                            <button type="button" class="toggle-password" data-target="newPassword" aria-label="Show password">
                                👁
                            </button>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" id="confirmPassword" placeholder="Re-enter new password">
                            <button type="button" class="toggle-password" data-target="confirmPassword" aria-label="Show password">
                                👁
                            </button>
                        </div>
                    </div>

                    <div class="password-rules">
                        <div class="rule" id="rule-length">
                            <span class="dot">●</span>
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
                        <div class="rule" id="rule-match">
                            <span class="dot">●</span>
                            <span>Password confirmation must match</span>
                        </div>
                    </div>

                    <button type="submit" class="save-btn">
                        Save New Password
                    </button>

                    <a href="{{ route('login') }}" class="back-login">
                        ← Back to Login
                    </a>
                </form>
            </div>
        </section>
    </div>

    <!-- SUCCESS MODAL -->
    <div class="success-modal-overlay" id="successModal">
        <div class="success-modal">
            <button type="button" class="close-modal" id="closeModalBtn" aria-label="Close modal">×</button>

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

    <script src="{{ asset('js/inputPassword.js') }}"></script>
</body>
</html>