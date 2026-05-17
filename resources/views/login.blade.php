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

      <div class="hero">
        <h1>Welcome to <span>Sproutly</span></h1>
        <p>Smart plant consultation and modern agriculture insights for sustainable growth.</p>

        <div class="feature-list">
          <div class="feature-item"><div class="check-circle">✓</div><span>Expert plant consultation</span></div>
          <div class="feature-item"><div class="check-circle">✓</div><span>Smart agriculture technology</span></div>
          <div class="feature-item"><div class="check-circle">✓</div><span>Sustainable farming insights</span></div>
        </div>
      </div>
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

          @if(session('error'))
            <div class="error-text" style="display:block; margin-bottom:12px;">
              {{ session('error') }}
            </div>
          @endif

          <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="field">
              <label for="email">Email address</label>
              <div class="input-wrap">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
              </div>
            </div>

            <div class="field">
              <label for="password">Password</label>
              <div class="input-wrap">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button class="pw-toggle" type="button" id="togglePassword" aria-label="Toggle password">
                  👁
                </button>
              </div>
            </div>

            <div class="row-options">
              <label class="remember">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
              </label>
              <a href="{{ url('/lupapass') }}" class="forgot">Forgot password?</a>
            </div>

            <button class="login-btn" id="loginBtn" type="submit">Log In</button>
          </form>

          <div class="divider">Or continue with</div>

          <div class="social-row">
            <button class="social-btn" type="button">Google</button>
            <button class="social-btn" type="button">Apple</button>
          </div>

          <div class="signup">
            Don't have an account?<br>
            <a href="{{ route('register') }}">Sign up</a>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('js/script-login.js') }}"></script>
</body>
</html>