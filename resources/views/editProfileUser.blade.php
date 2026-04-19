<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Edit Profile</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- Font Awesome — untuk icon sidebar -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style-editProfileUser.css') }}">
</head>
<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeUser') }}" class="logo-wrap">
        <div class="logo-box">
          <!-- Pastikan file logo-hijau.png ada di folder public/images -->
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>

    <div class="sidebar-line"></div>

    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-user') }}" class="menu-link">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
      </a>
      <a href="{{ url('/consultationUser') }}" class="menu-link">
        <i class="fa-solid fa-comments"></i>
        <span>Consultation</span>
      </a>
      <a href="{{ url('/daftarArtikel') }}" class="menu-link">
        <i class="fa-solid fa-newspaper"></i>
        <span>Article</span>
      </a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link">
        <i class="fa-solid fa-bookmark"></i>
        <span>Bookmarked Article</span>
      </a>
      <a href="{{ url('/reviewsUser') }}" class="menu-link">
        <i class="fa-solid fa-star"></i>
        <span>Reviews</span>
      </a>
      <a href="{{ url('/invoice') }}" class="menu-link">
        <i class="fa-solid fa-credit-card"></i>
        <span>Payment</span>
      </a>
      <a href="{{ url('/supportUser') }}" class="menu-link active">
        <i class="fa-solid fa-gear"></i>
        <span>Setting</span>
      </a>
    </nav>
  </aside>

  <!-- ========================
       MAIN LAYOUT
  ========================= -->
  <div class="layout" id="mainContent">

    <!-- TOP NAV -->
    <header class="topnav">
      <button class="burger-btn" id="sidebarToggle" aria-label="Toggle sidebar">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="topnav-title">
        <h1>Edit Profile</h1>
      </div>
    </header>

    <!-- PAGE BODY -->
    <main class="page-body">

      <div class="form-card">

        <!-- AVATAR SECTION -->
        <div class="avatar-section">
          <div class="avatar-wrap" id="avatarWrap">
            <img
              src="https://randomuser.me/api/portraits/women/44.jpg"
              alt="Profile Photo"
              class="avatar-img"
              id="avatarImg"
            />
            <label for="photoInput" class="avatar-edit-btn" title="Change photo">
              ✏️
            </label>
            <input
              type="file"
              id="photoInput"
              name="photo"
              accept="image/*"
              class="photo-input"
            />
          </div>

          <div class="avatar-actions">
            <label for="photoInput" class="btn-change-photo">Change Photo</label>
            <button type="button" class="btn-remove-photo" id="removePhoto">Remove</button>
          </div>
        </div>

        <!-- FORM -->
        <form class="edit-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-grid">

            <!-- Full Name -->
            <div class="form-group">
              <label class="form-label" for="full_name">Full Name</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                  </svg>
                </span>
                <input
                  type="text"
                  id="full_name"
                  name="full_name"
                  class="form-input @error('full_name') is-error @enderror"
                  value="{{ old('full_name', auth()->user()->name ?? 'Sarah Johnson') }}"
                  required
                />
              </div>
              @error('full_name')
                <span class="field-error">{{ $message }}</span>
              @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
              <label class="form-label" for="email">Email Address</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                  </svg>
                </span>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-input @error('email') is-error @enderror"
                  value="{{ old('email', auth()->user()->email ?? 'sarah.johnson@email.com') }}"
                  required
                />
              </div>
              @error('email')
                <span class="field-error">{{ $message }}</span>
              @enderror
            </div>

            <!-- Phone Number -->
            <div class="form-group">
              <label class="form-label" for="phone">Phone Number</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6.29 6.29l.97-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                  </svg>
                </span>
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  class="form-input @error('phone') is-error @enderror"
                  value="{{ old('phone', auth()->user()->phone ?? '+1 (555) 000-0000') }}"
                />
              </div>
              @error('phone')
                <span class="field-error">{{ $message }}</span>
              @enderror
            </div>

            <!-- Gender -->
            <div class="form-group">
              <label class="form-label" for="gender">Gender</label>
              <div class="input-wrap select-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                  </svg>
                </span>
                <select
                  id="gender"
                  name="gender"
                  class="form-input form-select @error('gender') is-error @enderror"
                >
                  <option value="" disabled>Select gender</option>
                  <option value="male"   {{ old('gender', auth()->user()->gender ?? '') == 'male'   ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender', auth()->user()->gender ?? 'female') == 'female' ? 'selected' : '' }}>Female</option>
                  <option value="other"  {{ old('gender', auth()->user()->gender ?? '') == 'other'  ? 'selected' : '' }}>Prefer not to say</option>
                </select>
                <span class="select-chevron">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                  </svg>
                </span>
              </div>
              @error('gender')
                <span class="field-error">{{ $message }}</span>
              @enderror
            </div>

          </div><!-- /.form-grid -->

          <!-- ACTION BUTTONS -->
          <div class="form-actions">
            <a href="{{ route('accountUser') ?? '#' }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Save Changes</button>
          </div>

        </form>
      </div>

    </main>
  </div><!-- /.layout -->

  <!-- Footer -->
  <footer class="site-footer">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-brand-top">
          <div class="footer-logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
          </div>
          <div>
            <h3>Sproutly</h3>
            <span>by AVI</span>
          </div>
        </div>
        <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
      </div>

      <div class="footer-links">
        <h4>About Us</h4>
        <a href="#">Our Team</a>
        <a href="#">Blog</a>
        <a href="#">Privacy Policy</a>
      </div>

      <div class="footer-contact">
        <h4>Contact</h4>
        <p><i class="fa-solid fa-envelope"></i> sproutly@gmail.com</p>
        <p><i class="fa-solid fa-phone"></i> +62 851 5693 2186</p>
        <div class="social-icons">
          <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
          <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
          <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2025 Sproutly by AVI. All rights reserved.
    </div>
  </footer>

  <script src="{{ asset('js/script-editProfileUser.js') }}"></script>
</body>
</html>