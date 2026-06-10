<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Register</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style-register.css') }}">
</head>
<body data-active-role="{{ old('form_type', 'user') }}">

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
      <div class="deco-sprout" id="decoEmoji"></div>

      <!-- Left content: User -->
      <div class="left-content" id="leftUser">
        <h1 class="left-heading">
          Welcome to<br>
          <span class="heading-accent">Sproutly</span>
        </h1>
        <p class="left-sub">
          Smart plant consultation and modern agriculture insights for sustainable growth.
        </p>
        <ul class="left-checklist">
          <li><span class="check-icon">✓</span> Expert plant consultation</li>
          <li><span class="check-icon">✓</span> Smart agriculture technology</li>
          <li><span class="check-icon">✓</span> Sustainable farming insights</li>
        </ul>
      </div>

      <!-- Left content: Expert -->
      <div class="left-content left-content--hidden" id="leftExpert">
        <h1 class="left-heading">
          Share Your<br>
          <span class="heading-accent">Plant Expertise</span>
        </h1>
        <p class="left-sub">
          Help plant lovers grow healthier plants through expert consultation and sustainable agricultural knowledge.
        </p>
        <ul class="left-checklist">
          <li><span class="check-icon">✓</span> Connect with plant enthusiasts</li>
          <li><span class="check-icon">✓</span> Share professional plant knowledge</li>
          <li><span class="check-icon">✓</span> Support sustainable agriculture</li>
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

        <!-- ====== TOGGLE SWITCH ====== -->
        <div class="role-toggle-wrapper">
          <div class="role-toggle" id="roleToggle">
            <div class="toggle-slider" id="toggleSlider"></div>
            <button type="button" class="toggle-btn toggle-btn--active" id="btnUser" data-role="user">
              User
            </button>
            <button type="button" class="toggle-btn" id="btnExpert" data-role="expert">
              Expert
            </button>
          </div>
        </div>

        <!-- Headings -->
        <h2 class="form-title" id="formTitle">Create Account</h2>
        <p class="form-subtitle" id="formSubtitle">Start your plant consultation journey</p>

        <!-- ====== USER FORM ====== -->
        <form class="register-form" id="formUser" method="POST" action="{{ route('registerUser.submit') }}">
          @csrf
          <input type="hidden" name="form_type" value="user">

          <div class="form-group">
            <input type="text" name="full_name" class="form-input @error('full_name') is-error @enderror"
              placeholder="Enter your full name" value="{{ old('full_name') }}" required />
            @error('full_name')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <input type="tel" name="phone" class="form-input @error('phone') is-error @enderror"
              placeholder="Enter your phone number" value="{{ old('phone') }}" required />
            @error('phone')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <input type="date" name="birthdate" class="form-input form-input--date @error('birthdate') is-error @enderror"
              value="{{ old('birthdate') }}" required />
            @error('birthdate')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <input type="email" name="email" class="form-input @error('email') is-error @enderror"
              placeholder="Enter your email" value="{{ old('email') }}" required />
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group select-wrapper">
            <select name="gender" class="form-input form-select @error('gender') is-error @enderror" required>
              <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select your gender</option>
              <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Prefer not to say</option>
            </select>
            <span class="select-arrow">&#8744;</span>
            @error('gender')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group password-group">
            <input type="password" name="password" id="user_password"
              class="form-input @error('password') is-error @enderror"
              placeholder="Enter your password" required />
            <button type="button" class="toggle-pw" data-target="user_password" aria-label="Toggle password">
              <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group password-group">
            <input type="password" name="password_confirmation" id="user_password_confirm"
              class="form-input" placeholder="Confirm your password" required />
            <button type="button" class="toggle-pw" data-target="user_password_confirm" aria-label="Toggle confirm password">
              <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>

          <button type="submit" class="btn-register">Create Account</button>



          <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </form>

        <!-- ====== EXPERT FORM ====== -->
        <form class="register-form register-form--hidden"
          id="formExpert"
          method="POST"
          action="{{ route('registerExpert.submit') }}"
          enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="form_type" value="expert">
          <div class="form-group">
            <input type="text" name="full_name" class="form-input"
              placeholder="Enter your full name" required />
          </div>

          <div class="form-group">
            <input type="tel" name="phone" class="form-input"
              placeholder="Enter your phone number" required />
          </div>

          <div class="form-group">
            <input type="date" name="birthdate" class="form-input form-input--date" required />
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-input"
              placeholder="Enter your email" required />
          </div>

          <div class="form-group select-wrapper">
            <select name="gender" class="form-input form-select @error('gender') is-error @enderror" required>
              <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select your gender</option>
              <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Prefer not to say</option>
            </select>
            <span class="select-arrow">&#8744;</span>
            @error('gender')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-input"
              placeholder="Enter your password" required />
          </div>

          <div class="form-group">
            <input type="password" name="password_confirmation" class="form-input"
              placeholder="Confirm your password" required />
          </div>

          <div class="form-group">
            <input type="text" name="institution" class="form-input"
              placeholder="Enter your university or institution" required />
          </div>

          <div class="form-group">
            <input type="text" name="location" class="form-input"
              placeholder="Enter your city or region" required />
          </div>

          <div class="form-group">
            <input type="text" name="bank_account" class="form-input"
              placeholder="Enter your bank name and account number" required />
          </div>

          <div class="form-group">
            <textarea name="experience" class="form-input form-textarea"
              placeholder="Describe your professional experience" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label class="file-upload" id="fileLabel">
              <input type="file" name="certification" id="certFile"
                accept=".pdf,.jpg,.jpeg,.png" class="file-input" />
              <div class="file-upload-inner">
                <span class="upload-icon">☁️</span>
                <span class="upload-text" id="uploadText">Upload certification document (PDF, JPG, PNG)</span>
              </div>
            </label>
          </div>

          <button type="submit" class="btn-register">Register as Expert</button>



          <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </form>

      </div>
    </div>

  </div>

  <script src="{{ asset('js/script-register.js') }}"></script>
</body>
</html>