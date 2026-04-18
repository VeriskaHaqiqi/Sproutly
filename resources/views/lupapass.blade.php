<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly – Forgot Password</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-forgot-password.css') }}">
</head>
<body>
  <div class="page">
    <!-- LEFT -->
    <section class="left">
      <div class="circle c1"></div>
      <div class="circle c2"></div>
      <div class="circle c3"></div>
      <div class="circle c4"></div>
      <div class="circle c5"></div>
      <div class="circle c6"></div>

      <div class="top-icons">
        <svg class="top-leaf" viewBox="0 0 64 54" fill="none" aria-hidden="true">
          <path d="M8 28C8 28 5 17 13 11C22 4 33 8 31 20C29 30 18 32 12 30" fill="#2ea66f"/>
          <path d="M30 40C30 40 26 20 42 11C52 6 62 12 62 24C62 41 44 49 34 47" fill="#53c6ae"/>
          <path d="M30 48V24" stroke="#53c6ae" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </div>

      <div class="hero">
        <h1>Reset Your <span>Password</span></h1>
        <p>Enter your email address and we will send you a reset link.</p>
      </div>

      <svg class="mini-leaf-center" viewBox="0 0 60 60" fill="none" aria-hidden="true">
        <path d="M30 52V26" stroke="#2ea66f" stroke-width="4" stroke-linecap="round"/>
        <path d="M30 32C30 32 18 28 16 16C16 16 26 13 32 22C34 25 32 30 30 32Z" fill="#2ea66f"/>
        <path d="M30 36C30 36 40 30 44 20C44 20 47 29 41 35C38 38 32 38 30 36Z" fill="#53c6ae"/>
      </svg>

      <svg class="mini-leaf-bottom" viewBox="0 0 60 60" fill="none" aria-hidden="true">
        <path d="M30 44C30 44 16 36 14 22C14 22 26 18 33 28C35 31 33 40 30 44Z" fill="#4bc3c6"/>
        <path d="M30 44C30 44 41 36 46 24C46 24 50 36 42 42C38 46 32 46 30 44Z" fill="#38b2ac"/>
      </svg>
    </section>

    <!-- RIGHT -->
    <section class="right">
      <div class="card">
        <div class="brand">
          <img src="{{ asset('images/logo-tosca.png') }}" alt="Sproutly Logo" class="brand-logo">
          <h2>Sproutly</h2>
        </div>

        <h1 class="card-title">Forgot your password?</h1>
        <p class="card-subtitle">
          No worries! Just enter your email address below and we'll send you a link to reset your password.
        </p>

        <form id="forgotPasswordForm" novalidate>
          <div class="field">
            <label for="email">Email Address</label>
            <div class="input-wrap">
              <span class="icon-left" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                  <path d="M2.5 4.5H15.5C16.33 4.5 17 5.17 17 6V12C17 12.83 16.33 13.5 15.5 13.5H2.5C1.67 13.5 1 12.83 1 12V6C1 5.17 1.67 4.5 2.5 4.5Z" fill="#9CA3AF"/>
                  <path d="M2 5.5L9 10L16 5.5" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="you@example.com"
                autocomplete="email"
                inputmode="email"
              />
            </div>
            <div class="error-text" id="emailError">This field is required.</div>
          </div>

          <button type="submit" class="reset-btn" id="resetBtn">
            <span>Send Reset Link</span>
            <svg class="send-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
              <path d="M16 2L8 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M16 2L11 16L8 10L2 7L16 2Z" fill="currentColor"/>
            </svg>
          </button>
        </form>

        <a href="{{ url('/login') }}" class="back-link">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
            <path d="M11 4L6 9L11 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7 9H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <span>Back to Login</span>
        </a>

        <div class="divider"></div>

        <p class="helper-text">
          If you don't receive an email within 5 minutes, check your spam folder or contact our support team.
        </p>
      </div>
    </section>
  </div>

  <!-- POPUP -->
  <div class="modal-overlay" id="successModal" aria-hidden="true">
    <div class="modal">
      <div class="modal-icon">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true">
          <circle cx="14" cy="14" r="14" fill="#76ead0"/>
          <path d="M8 14.5L12 18.5L20 10.5" stroke="#166534" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <h3>Reset link sent</h3>
      <p>A password reset link has been sent to your email address.</p>
      <button type="button" class="modal-btn" id="closeModalBtn">OK</button>
    </div>
  </div>

  <script src="{{ asset('js/script-forgot-password.js') }}"></script>
</body>
</html>