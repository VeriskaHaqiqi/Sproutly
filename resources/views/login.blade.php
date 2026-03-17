<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sproutly — Log In</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/style-login.css') }}">

</head>
<body>

<div class="page">

  <!-- LEFT -->
  <div class="left">

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="blob blob-4"></div>

    <div class="left-inner">

      <div class="icon-row">
        <div class="icon-badge">🌱</div>
        <div class="icon-badge">🍃</div>
        <div class="icon-badge">☀️</div>
      </div>

      <h1>Welcome to<br><span>Sproutly</span></h1>

      <p class="sub">
        Smart plant consultation and modern agriculture insights for sustainable growth.
      </p>

      <ul class="features">
        <li>✔ Expert plant consultation</li>
        <li>✔ Smart agriculture technology</li>
        <li>✔ Sustainable farming insights</li>
      </ul>

    </div>
  </div>

  <!-- RIGHT -->
  <div class="right">

    <div class="logo-wrap">
      <div class="logo-icon">🌱</div>
      <span class="logo-name">Sproutly</span>
    </div>

    <div class="card">

      <h2>Welcome Back</h2>
      <p class="tagline">Log in to continue your plant consultation journey</p>

      <div class="field">
        <label>Email address</label>
        <div class="input-wrap">
          <input id="email" type="email" placeholder="Enter your email">
        </div>
        <div class="err-msg" id="email-err">Email wajib diisi.</div>
      </div>

      <div class="field">
        <label>Password</label>
        <div class="input-wrap">
          <input id="password" type="password" placeholder="Enter your password">
          <button class="eye-btn" type="button" id="eye-btn">👁</button>
        </div>
        <div class="err-msg" id="password-err">Password wajib diisi.</div>
      </div>

      <div class="row-mid">
        <label class="remember">
          <input type="checkbox"> Remember me
        </label>
        <a class="forgot" href="#">Forgot password?</a>
      </div>

      <button class="btn-login" id="btn-login">Log In</button>

      <div class="divider">Or continue with</div>

      <div class="social-row">
        <button class="btn-social">Google</button>
        <button class="btn-social">Apple</button>
      </div>

      <div class="signup-row">
        Don't have an account? <a href="#">Sign up</a>
      </div>

    </div>
  </div>

</div>

<script src="{{ asset('js/script-login.js') }}"></script>

</body>
</html>