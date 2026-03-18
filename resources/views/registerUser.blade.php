<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Create Account</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style-registerUser.css') }}">
</head>
<body>

  <div class="page-wrapper">

    <!-- ========================
         LEFT PANEL
    ========================= -->
    <div class="left-panel">
      <!-- Decorative circles -->
      <div class="deco deco--tl"></div>
      <div class="deco deco--tr"></div>
      <div class="deco deco--bl"></div>
      <div class="deco deco--br"></div>
      <div class="deco deco--mid"></div>

      <!-- Decorative sprout -->
      <div class="deco-sprout">🌱</div>

      <div class="left-content">
        <h1 class="left-heading">
          Welcome to<br>
          <span class="heading-accent">Sproutly</span>
        </h1>
        <p class="left-sub">
          Smart plant consultation and modern agriculture insights for
          sustainable growth.
        </p>

        <ul class="left-checklist">
          <li>
            <span class="check-icon">✓</span>
            Expert plant consultation
          </li>
          <li>
            <span class="check-icon">✓</span>
            Smart agriculture technology
          </li>
          <li>
            <span class="check-icon">✓</span>
            Sustainable farming insights
          </li>
        </ul>
      </div>
    </div>

    <!-- ========================
         RIGHT PANEL — FORM
    ========================= -->
    <div class="right-panel">
      <div class="form-card">

        <!-- Logo -->
        <div class="form-logo">
          <div class="logo-icon">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img" width="25"/>
          </div>
          <span class="logo-name">Sproutly</span>
        </div>

        <h2 class="form-title">Create Account</h2>
        <p class="form-subtitle">Start your plant consultation journey</p>

        <!-- Form -->
        <form class="register-form" method="POST" action="{{ route('registerUser.submit') }}">
          @csrf

          <!-- Full Name -->
          <div class="form-group">
            <input
              type="text"
              name="full_name"
              id="full_name"
              class="form-input @error('full_name') is-error @enderror"
              placeholder="Enter your full name"
              value="{{ old('full_name') }}"
              required
            />
            @error('full_name')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Phone -->
          <div class="form-group">
            <input
              type="tel"
              name="phone"
              id="phone"
              class="form-input @error('phone') is-error @enderror"
              placeholder="Enter your phone number"
              value="{{ old('phone') }}"
              required
            />
            @error('phone')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Date of Birth -->
          <div class="form-group">
            <input
              type="date"
              name="birthdate"
              id="birthdate"
              class="form-input form-input--date @error('birthdate') is-error @enderror"
              value="{{ old('birthdate') }}"
              required
            />
            @error('birthdate')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Email -->
          <div class="form-group">
            <input
              type="email"
              name="email"
              id="email"
              class="form-input @error('email') is-error @enderror"
              placeholder="Enter your email"
              value="{{ old('email') }}"
              required
            />
            @error('email')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Gender -->
          <div class="form-group select-wrapper">
            <select
              name="gender"
              id="gender"
              class="form-input form-select @error('gender') is-error @enderror"
              required
            >
              <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select your gender</option>
              <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Prefer not to say</option>
            </select>
            <span class="select-arrow">&#8744;</span>
            @error('gender')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Password -->
          <div class="form-group password-group">
            <input
              type="password"
              name="password"
              id="password"
              class="form-input @error('password') is-error @enderror"
              placeholder="Enter your password"
              required
            />
            <button type="button" class="toggle-pw" data-target="password" aria-label="Toggle password">
              <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
            @error('password')
              <span class="field-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="form-group password-group">
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              class="form-input"
              placeholder="Confirm your password"
              required
            />
            <button type="button" class="toggle-pw" data-target="password_confirmation" aria-label="Toggle confirm password">
              <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn-register">
            Create Account
          </button>

          <!-- Divider -->
          <div class="divider"><span>Or continue with</span></div>

          <!-- Social -->
          <a href="{{ Route::has('auth.google') ? route('auth.google') : '#' }}" class="btn-social btn-social--full">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.64 9.2045c0-.6381-.0573-1.2518-.1636-1.8409H9v3.4814h4.8436c-.2086 1.125-.8427 2.0782-1.7959 2.7164v2.2581h2.9087c1.7018-1.5668 2.6836-3.874 2.6836-6.615z" fill="#4285F4"/>
              <path d="M9 18c2.43 0 4.4673-.806 5.9564-2.1805l-2.9087-2.2581c-.8059.54-1.8368.859-3.0477.859-2.344 0-4.3282-1.5836-5.036-3.7109H.9574v2.3318C2.4382 15.9832 5.4818 18 9 18z" fill="#34A853"/>
              <path d="M3.964 10.71c-.18-.54-.2822-1.1168-.2822-1.71s.1023-1.17.2822-1.71V4.9582H.9574C.3477 6.1732 0 7.5477 0 9s.3477 2.8268.9574 4.0418L3.964 10.71z" fill="#FBBC05"/>
              <path d="M9 3.5795c1.3214 0 2.5077.4541 3.4405 1.346l2.5813-2.5814C13.4627.8918 11.4255 0 9 0 5.4818 0 2.4382 2.0168.9574 4.9582L3.964 7.29C4.6718 5.1627 6.656 3.5795 9 3.5795z" fill="#EA4335"/>
            </svg>
            Continue with Google
          </a>

          <a href="{{ Route::has('auth.apple') ? route('auth.apple') : '#' }}" class="btn-social btn-social--full">
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.173 9.545c-.022-2.557 2.087-3.79 2.182-3.849-1.19-1.738-3.038-1.976-3.692-2.001-1.572-.16-3.074.928-3.872.928-.797 0-2.025-.907-3.332-.882C2.843 3.766 1.26 4.73.454 6.243c-1.626 2.809-.416 6.962 1.168 9.24.776 1.116 1.7 2.366 2.914 2.32 1.172-.047 1.612-.752 3.028-.752 1.416 0 1.815.752 3.054.727 1.261-.022 2.059-1.136 2.828-2.256.893-1.292 1.261-2.546 1.282-2.61-.028-.013-2.453-.94-2.555-3.367z" fill="#1D1D1F"/>
              <path d="M10.73 2.394C11.354 1.625 11.77.57 11.65-.5c-.906.04-2.002.606-2.65 1.37-.582.674-1.09 1.754-.953 2.787.997.077 2.018-.506 2.683-1.263z" fill="#1D1D1F"/>
            </svg>
            Continue with Apple
          </a>

          <!-- Login link -->
          <p class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Log in</a>
          </p>

        </form>
      </div>
    </div>

  </div>

  <script src="{{ asset('js/script-registerUser.js') }}"></script>
</body>
</html>