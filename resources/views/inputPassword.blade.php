<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-inputPassword.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="reset-page">
        <!-- LEFT SIDE -->
        <section class="reset-visual">
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
            <div class="bg-circle circle-3"></div>
            <div class="bg-circle circle-4"></div>
            <div class="bg-circle circle-5"></div>


            <div class="visual-content">
                <h1>
                    <span class="white-text">Reset Your</span>
                    <span class="green-text">Password</span>
                </h1>
                <p>Create a new secure password to continue your journey with Sproutly.</p>
            </div>

            <div class="small-leaf leaf-a">🌱</div>
            <div class="small-leaf leaf-b">🌿</div>
        </section>

        <!-- RIGHT SIDE -->
        <section class="reset-form-section">
            <div class="form-card">
                <div class="brand-wrap">
                    <div class="brand-logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                    </div>
                    <div class="brand-text">Sproutly</div>
                </div>

                <div class="form-heading">
                    <h2>Create New Password</h2>
                    <p>Your new password must be different from your previous password.</p>
                </div>

                <form id="passwordForm" novalidate>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <div class="input-wrap">
                            <input type="password" id="newPassword" placeholder="Enter new password">
                            <button type="button" class="toggle-password" data-target="newPassword">👁</button>
                        </div>
                        <p class="error-text" id="newPasswordError"></p>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="input-wrap">
                            <input type="password" id="confirmPassword" placeholder="Re-enter new password">
                            <button type="button" class="toggle-password" data-target="confirmPassword">👁</button>
                        </div>
                        <p class="error-text" id="confirmPasswordError"></p>
                    </div>

                    <div class="password-rules">
                        <div class="rule-item" id="ruleLength">
                            <span class="rule-icon">✓</span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="rule-item" id="ruleUpperLower">
                            <span class="rule-icon">✓</span>
                            <span>Include uppercase and lowercase letters</span>
                        </div>
                        <div class="rule-item" id="ruleNumber">
                            <span class="rule-icon">✓</span>
                            <span>Include at least one number</span>
                        </div>
                    </div>

                    <button type="submit" class="save-btn">Save New Password</button>

                    <a href="/login" class="back-login">← Back to Login</a>
                </form>
            </div>
        </section>
    </div>

    <!-- SUCCESS MODAL -->
    <div class="modal-overlay" id="successModal">
        <div class="success-modal">
            <button type="button" class="close-modal" id="closeModalBtn">×</button>

            <div class="success-icon-wrap">
                <div class="success-icon">✓</div>
            </div>

            <h3>Password Successfully Updated</h3>
            <p>
                Your new password has been successfully created. You can now log in to your
                account and continue where you left off.
            </p>

            <a href="/login" class="modal-login-btn">Back to Login</a>

            <div class="modal-help">
                Need help? <a href="#">Contact support</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script-inputPassword.js') }}"></script>
</body>
</html>