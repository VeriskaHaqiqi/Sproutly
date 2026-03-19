<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly – Log In</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
</head>
<body>
  <div class="page">
    <section class="left">
      <div class="circle c1"></div>
      <div class="circle c2"></div>
      <div class="circle c3"></div>
      <div class="circle c4"></div>
      <div class="circle c5"></div>

      <div class="top-icons">
        <div class="top-icon-box">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M12 21V10" stroke="#176534" stroke-width="2.2" stroke-linecap="round"/>
            <path d="M12 13.5C12 13.5 7 11.8 6 7C6 7 10.4 5.5 13.2 8.9C14 9.9 13.2 12.4 12 13.5Z" fill="#176534"/>
            <path d="M12 15C12 15 16.2 13.5 18 10C18 10 19.2 14.2 16.4 16.2C14.7 17.4 12.5 15.7 12 15Z" fill="#176534"/>
          </svg>
        </div>

        <div class="top-icon-box">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4.8 16.8C4.8 16.8 3.7 10.3 8.8 6.5C13.3 3.1 19.4 5.8 18.7 11.7C18.1 16.4 12.8 18.6 8 17.4" fill="#176534"/>
            <path d="M8.5 15.8L14.8 9.6" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
          </svg>
        </div>

        <svg class="top-leaf" viewBox="0 0 64 54" fill="none">
          <path d="M8 28C8 28 5 17 13 11C22 4 33 8 31 20C29 30 18 32 12 30" fill="#2ea66f"/>
          <path d="M30 40C30 40 26 20 42 11C52 6 62 12 62 24C62 41 44 49 34 47" fill="#53c6ae"/>
          <path d="M30 48V24" stroke="#53c6ae" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </div>

      <div class="hero">
        <h1>Welcome to <span>Sproutly</span></h1>
        <p>
          Smart plant consultation and modern agriculture
          insights for sustainable growth.
        </p>

        <div class="feature-list">
          <div class="feature-item">
            <div class="check-circle">
              <svg viewBox="0 0 16 16" fill="none">
                <path d="M3 8L6.4 11.2L13 4.5" stroke="#176534" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <span>Expert plant consultation</span>
          </div>

          <div class="feature-item">
            <div class="check-circle">
              <svg viewBox="0 0 16 16" fill="none">
                <path d="M3 8L6.4 11.2L13 4.5" stroke="#176534" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <span>Smart agriculture technology</span>
          </div>

          <div class="feature-item">
            <div class="check-circle">
              <svg viewBox="0 0 16 16" fill="none">
                <path d="M3 8L6.4 11.2L13 4.5" stroke="#176534" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <span>Sustainable farming insights</span>
          </div>
        </div>
      </div>

      <svg class="mini-leaf-center" viewBox="0 0 60 60" fill="none">
        <path d="M30 52V26" stroke="#2ea66f" stroke-width="4" stroke-linecap="round"/>
        <path d="M30 32C30 32 18 28 16 16C16 16 26 13 32 22C34 25 32 30 30 32Z" fill="#2ea66f"/>
        <path d="M30 36C30 36 40 30 44 20C44 20 47 29 41 35C38 38 32 38 30 36Z" fill="#53c6ae"/>
      </svg>

      <svg class="mini-leaf-bottom" viewBox="0 0 60 60" fill="none">
        <path d="M30 44C30 44 16 36 14 22C14 22 26 18 33 28C35 31 33 40 30 44Z" fill="#4bc3c6"/>
        <path d="M30 44C30 44 41 36 46 24C46 24 50 36 42 42C38 46 32 46 30 44Z" fill="#38b2ac"/>
      </svg>
    </section>

    <section class="right">
      <div class="right-wrap">
        <div class="brand">
          <div class="brand-icon">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
          </div>
          <h2>Sproutly</h2>
        </div>

        <div class="card">
          <h1 class="card-title">Welcome Back</h1>
          <p class="card-subtitle">
            Log in to continue your plant consultation journey
          </p>

          <div class="field">
            <label for="email">Email address</label>
            <div class="input-wrap">
              <span class="icon-left">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <path d="M2.2 4.1H13.8C14.46 4.1 15 4.64 15 5.3V10.7C15 11.36 14.46 11.9 13.8 11.9H2.2C1.54 11.9 1 11.36 1 10.7V5.3C1 4.64 1.54 4.1 2.2 4.1Z" stroke="currentColor" stroke-width="1.4"/>
                  <path d="M1.8 5L8 9.2L14.2 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <input type="email" id="email" placeholder="Enter your email" />
            </div>
            <div class="error-text" id="emailError">This field is required.</div>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <div class="input-wrap">
              <span class="icon-left">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <rect x="3" y="7" width="10" height="7" rx="1.6" stroke="currentColor" stroke-width="1.4"/>
                  <path d="M5 7V5.2C5 3.43 6.34 2 8 2C9.66 2 11 3.43 11 5.2V7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
              </span>
              <input type="password" id="password" placeholder="Enter your password" />
              <button class="pw-toggle" type="button" id="togglePassword" aria-label="Toggle password">
                <svg id="eyeOpen" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <path d="M1.5 8C2.4 6.3 4.6 4 8 4C11.4 4 13.6 6.3 14.5 8C13.6 9.7 11.4 12 8 12C4.6 12 2.4 9.7 1.5 8Z" stroke="currentColor" stroke-width="1.4"/>
                  <circle cx="8" cy="8" r="2" fill="currentColor"/>
                </svg>
                <svg id="eyeClosed" width="16" height="16" viewBox="0 0 16 16" fill="none" style="display:none;">
                  <path d="M2 2L14 14" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                  <path d="M1.5 8C2.4 6.3 4.6 4 8 4C9.1 4 10.1 4.24 11 4.63" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                  <path d="M14.5 8C13.6 9.7 11.4 12 8 12C6.9 12 5.89 11.76 5 11.37" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
            <div class="error-text" id="passwordError">This field is required.</div>
          </div>

          <div class="row-options">
            <label class="remember">
              <input type="checkbox" />
              <span>Remember me</span>
            </label>

            <a href="{{ url('/lupapass') }}" class="forgot">Forgot password?</a>
          </div>

          <button class="login-btn" id="loginBtn">Log In</button>

          <div class="divider">Or continue with</div>

          <div class="social-row">
            <button class="social-btn" type="button">
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17.64 9.2C17.64 8.57 17.58 7.96 17.47 7.37H9V10.84H13.84C13.63 11.97 12.99 12.93 12.02 13.57V15.82H14.93C16.66 14.22 17.64 11.93 17.64 9.2Z" fill="#4285F4"/>
                <path d="M9 18C11.43 18 13.47 17.19 14.93 15.82L12.02 13.57C11.22 14.1 10.21 14.42 9 14.42C6.65 14.42 4.67 12.82 3.96 10.67H0.96V12.99C2.41 15.87 5.48 18 9 18Z" fill="#34A853"/>
                <path d="M3.96 10.67C3.78 10.14 3.68 9.58 3.68 9C3.68 8.42 3.78 7.86 3.96 7.33V5.01H0.96C0.35 6.21 0 7.57 0 9C0 10.43 0.35 11.79 0.96 12.99L3.96 10.67Z" fill="#FBBC05"/>
                <path d="M9 3.58C10.32 3.58 11.51 4.04 12.44 4.93L15.02 2.35C13.47 0.9 11.43 0 9 0C5.48 0 2.41 2.13 0.96 5.01L3.96 7.33C4.67 5.18 6.65 3.58 9 3.58Z" fill="#EA4335"/>
              </svg>
              Google
            </button>

            <button class="social-btn" type="button">
              <svg width="15" height="18" viewBox="0 0 16 18" fill="none">
                <path d="M13.18 9.56C13.16 7.53 14.86 6.56 14.94 6.51C13.94 5.06 12.38 4.86 11.83 4.84C10.5 4.71 9.21 5.63 8.53 5.63C7.84 5.63 6.78 4.86 5.66 4.88C4.22 4.9 2.87 5.73 2.13 7.03C0.6 9.64 1.72 13.46 3.19 15.56C3.93 16.59 4.79 17.74 5.93 17.7C7.04 17.66 7.46 16.99 8.79 16.99C10.11 16.99 10.5 17.7 11.66 17.68C12.84 17.66 13.59 16.63 14.31 15.59C15.17 14.4 15.51 13.23 15.53 13.17C15.5 13.16 13.2 12.27 13.18 9.56Z" fill="#111827"/>
                <path d="M10.94 3.29C11.53 2.57 11.93 1.58 11.82 0.58C10.96 0.62 9.89 1.17 9.28 1.87C8.73 2.5 8.25 3.52 8.38 4.49C9.34 4.56 10.32 4 10.94 3.29Z" fill="#111827"/>
              </svg>
              Apple
            </button>
          </div>

          <div class="signup">
            Don't have an account?<br>
            <a href="{{ route('registerUser') }}">Sign up</a>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('js/script-login.js') }}"></script>
</body>
</html>