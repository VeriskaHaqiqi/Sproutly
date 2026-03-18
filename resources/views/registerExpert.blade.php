<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Register as Expert</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  {{-- <link rel="stylesheet" href="{{ asset('css/expert-register.css') }}"> --}}
  <link rel="stylesheet" href="{{asset('css/style-registerExpert.css')}}" />
</head>
<body>

  <div class="page-wrapper">

    <!-- ========================
         LEFT PANEL
    ========================= -->
    <div class="left-panel">
      <!-- Decorative circles -->
      <div class="deco-circle deco-circle--top"></div>
      <div class="deco-circle deco-circle--bottom"></div>
      <div class="deco-circle deco-circle--mid"></div>

      <!-- Decorative leaf -->
      <div class="deco-leaf">🌿</div>

      <div class="left-content">

        <h1 class="left-heading">Share Your Plant<br>Expertise</h1>
        <p class="left-sub">
          Help plant lovers grow healthier plants through expert consultation
          and sustainable agricultural knowledge.
        </p>

        <ul class="left-checklist">
          <li>
            <span class="check-icon">✓</span>
            Connect with plant enthusiasts
          </li>
          <li>
            <span class="check-icon">✓</span>
            Share professional plant knowledge
          </li>
          <li>
            <span class="check-icon">✓</span>
            Support sustainable agriculture
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
            <img src="{{ asset('images/logo.png') }}" width="30" > 
          </div>
          <span class="logo-name">Sproutly</span>
        </div>

        <h2 class="form-title">Register as Botanist Expert</h2>
        <p class="form-subtitle">Create your expert account to start helping plant owners</p>

        <!-- Form -->
        <form class="register-form" method="POST" action="#" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <input
              type="text"
              name="full_name"
              class="form-input"
              placeholder="Enter your full name"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="tel"
              name="phone"
              class="form-input"
              placeholder="Enter your phone number"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="date"
              name="birthdate"
              class="form-input form-input--date"
              placeholder="mm/dd/yyyy"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="text"
              name="institution"
              class="form-input"
              placeholder="Enter your university or institution"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="text"
              name="location"
              class="form-input"
              placeholder="Enter your city or region"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="text"
              name="bank_account"
              class="form-input"
              placeholder="Enter your bank name and account number"
              required
            />
          </div>

          <div class="form-group">
            <textarea
              name="experience"
              class="form-input form-textarea"
              placeholder="Describe your professional experience"
              rows="4"
              required
            ></textarea>
          </div>

          <!-- File Upload -->
          <div class="form-group">
            <label class="file-upload" id="fileLabel">
              <input
                type="file"
                name="certification"
                id="certFile"
                accept=".pdf,.jpg,.jpeg,.png"
                class="file-input"
              />
              <div class="file-upload-inner">
                <span class="upload-icon">☁️</span>
                <span class="upload-text" id="uploadText">
                  Upload certification document (PDF, JPG, PNG)
                </span>
              </div>
            </label>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn-register">
            Register as Expert
          </button>

          <!-- Divider -->
          <div class="divider">
            <span>Or continue with</span>
          </div>

          <!-- Social login -->
          <div class="social-btns">
            <a href="#" class="btn-social">
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.64 9.2045c0-.6381-.0573-1.2518-.1636-1.8409H9v3.4814h4.8436c-.2086 1.125-.8427 2.0782-1.7959 2.7164v2.2581h2.9087c1.7018-1.5668 2.6836-3.874 2.6836-6.615z" fill="#4285F4"/>
                <path d="M9 18c2.43 0 4.4673-.806 5.9564-2.1805l-2.9087-2.2581c-.8059.54-1.8368.859-3.0477.859-2.344 0-4.3282-1.5836-5.036-3.7109H.9574v2.3318C2.4382 15.9832 5.4818 18 9 18z" fill="#34A853"/>
                <path d="M3.964 10.71c-.18-.54-.2822-1.1168-.2822-1.71s.1023-1.17.2822-1.71V4.9582H.9574C.3477 6.1732 0 7.5477 0 9s.3477 2.8268.9574 4.0418L3.964 10.71z" fill="#FBBC05"/>
                <path d="M9 3.5795c1.3214 0 2.5077.4541 3.4405 1.346l2.5813-2.5814C13.4627.8918 11.4255 0 9 0 5.4818 0 2.4382 2.0168.9574 4.9582L3.964 7.29C4.6718 5.1627 6.656 3.5795 9 3.5795z" fill="#EA4335"/>
              </svg>
              Google
            </a>
            <a href="#" class="btn-social">
              <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.173 9.545c-.022-2.557 2.087-3.79 2.182-3.849-1.19-1.738-3.038-1.976-3.692-2.001-1.572-.16-3.074.928-3.872.928-.797 0-2.025-.907-3.332-.882C2.843 3.766 1.26 4.73.454 6.243c-1.626 2.809-.416 6.962 1.168 9.24.776 1.116 1.7 2.366 2.914 2.32 1.172-.047 1.612-.752 3.028-.752 1.416 0 1.815.752 3.054.727 1.261-.022 2.059-1.136 2.828-2.256.893-1.292 1.261-2.546 1.282-2.61-.028-.013-2.453-.94-2.555-3.367z" fill="#1D1D1F"/>
                <path d="M10.73 2.394C11.354 1.625 11.77.57 11.65-.5c-.906.04-2.002.606-2.65 1.37-.582.674-1.09 1.754-.953 2.787.997.077 2.018-.506 2.683-1.263z" fill="#1D1D1F"/>
              </svg>
              Apple
            </a>
          </div>

          <!-- Login link -->
          <p class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Log in</a>
          </p>

        </form>
      </div>
    </div>

  </div><!-- /.page-wrapper -->

  <!-- JavaScript -->
  {{-- <script src="{{ asset('js/expert-register.js') }}"></script> --}}
  <script src="{{ asset('js/script-registerExpert.js') }}"></script>

</body>
</html>