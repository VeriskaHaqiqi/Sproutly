<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Password - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style-inputPassword.css') }}">
</head>
<body>
    <div class="page-title">Input password</div>

    <div class="main-wrapper">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="bg-shape circle circle-1"></div>
            <div class="bg-shape circle circle-2"></div>
            <div class="bg-shape circle circle-3"></div>
            <div class="bg-shape circle circle-4"></div>
            <div class="bg-shape pill"></div>
            <div class="bg-shape half-circle"></div>

            <div class="floating-icons">
                <div class="icon-box">🌱</div>
                <div class="icon-box">🍃</div>
                <div class="icon-box">🪴</div>
            </div>

            <div class="left-content">
                <h1>Reset Your <br><span>Password</span></h1>
                <p>Create a new secure password to continue your journey with Sproutly.</p>
            </div>

            <div class="leaf leaf-1">🌱</div>
            <div class="leaf leaf-2">🍃</div>
            <div class="leaf leaf-3">🌿</div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="form-card">
                <div class="brand">
                    <div class="brand-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="6" fill="#67CAE2"/>
                            <path d="M12 6.5L16 15.5H14.3L13.45 13.45H10.55L9.7 15.5H8L12 6.5ZM11.05 12.2H12.95L12 9.85L11.05 12.2Z" fill="white"/>
                        </svg>
                    </div>
                    <span>Sproutly</span>
                </div>

                <h2>Create New Password</h2>
                <p class="subtitle">
                    Your new password must be different from your previous password.
                </p>

                <form id="resetPasswordForm">
                    <label for="newPassword">New Password</label>
                    <div class="input-group">
                        <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                        <button type="button" class="toggle-password" data-target="newPassword">👁</button>
                    </div>

                    <label for="confirmPassword">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter new password" required>
                        <button type="button" class="toggle-password" data-target="confirmPassword">👁</button>
                    </div>

                    <div class="password-rules">
                        <div class="rule" id="rule-length">
                            <span class="rule-icon">●</span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="rule" id="rule-case">
                            <span class="rule-icon">●</span>
                            <span>Include uppercase and lowercase letters</span>
                        </div>
                        <div class="rule" id="rule-number">
                            <span class="rule-icon">●</span>
                            <span>Include at least one number</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Save New Password</button>

                    <a href="login.html" class="back-link">← Back to Login</a>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/script-inputPassword.js') }}"></script>
</body>
</html>

