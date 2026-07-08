<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create New Password - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-inputPassword.css') }}">
</head>
<body>
    <!-- ... bagian kiri (visual) ... -->

    <section class="reset-form-section">
        <div class="form-card">
            <div class="brand-wrap">...</div>

            <form id="passwordForm" novalidate>
                @csrf
                {{-- EMAIL HIDDEN DIISI DARI QUERY STRING --}}
                <input type="hidden" name="email" id="resetEmail" value="{{ request()->query('email') }}">

                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <div class="input-wrap">
                        <input type="password" id="newPassword" name="password" placeholder="Enter new password" required>
                        <button type="button" class="toggle-password" data-target="newPassword">👁</button>
                    </div>
                    <p class="error-text" id="newPasswordError"></p>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <div class="input-wrap">
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Re-enter new password" required>
                        <button type="button" class="toggle-password" data-target="confirmPassword">👁</button>
                    </div>
                    <p class="error-text" id="confirmPasswordError"></p>
                </div>

                <!-- Password rules (sama seperti sebelumnya) -->
                <div class="password-rules">...</div>

                <button type="submit" class="save-btn" id="submitResetBtn">Save New Password</button>
                <a href="/login" class="back-login">← Back to Login</a>
            </form>
        </div>
    </section>

    <!-- Modal sukses (sama seperti sebelumnya) -->
    <div class="modal-overlay" id="successModal">...</div>

    <script src="{{ asset('js/script-inputPassword.js') }}"></script>
</body>
</html>