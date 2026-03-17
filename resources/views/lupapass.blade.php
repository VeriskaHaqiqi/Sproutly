<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly — Forgot Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --yellow:     #ffff9f;
      --lime:       #d0ff99;
      --green:      #99ff99;
      --teal:       #76ead0;
      --sky:        #76d7ea;
      --accent:     #3db89a;
      --accent-dark:#1f7a62;
      --white:      #ffffff;
      --gray-50:    #f8fffe;
      --gray-200:   #cdf0e8;
      --gray-400:   #7ab8ac;
      --gray-600:   #3a6b62;
      --gray-800:   #1a3a34;
      --error:      #e05555;
    }

    html, body {
      height: 100%;
      font-family: 'Inter', sans-serif;
      background: #e8fdf8;
    }

    .page {
      display: grid;
      grid-template-columns: 55fr 45fr;
      min-height: 100vh;
    }

    /* ── LEFT ── */
    .left {
      position: relative;
      overflow: hidden;
      background: linear-gradient(140deg, var(--yellow) 0%, var(--lime) 28%, var(--green) 52%, var(--teal) 76%, var(--sky) 100%);
    }

    .blob {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
    }
    .blob-1 { width: 280px; height: 280px; top: -80px;    left: -80px;   background: rgba(255,255,159,0.15); }
    .blob-2 { width: 380px; height: 380px; top: 100px;    right: -140px; background: rgba(118,234,208,0.10); }
    .blob-3 { width: 200px; height: 200px; bottom: 100px; left: 40px;    background: rgba(153,255,153,0.12); }
    .blob-4 { width: 300px; height: 300px; bottom: -100px;right: -60px;  background: rgba(118,215,234,0.09); }

    .left-inner {
      position: relative;
      z-index: 1;
      padding: 64px 60px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .icon-row { display: flex; gap: 10px; margin-bottom: 36px; }
    .icon-badge {
      width: 44px; height: 44px;
      border-radius: 12px;
      background: rgba(255,255,255,0.6);
      display: flex; align-items: center; justify-content: center;
      backdrop-filter: blur(4px);
    }
    .icon-badge svg { width: 22px; height: 22px; }

    .left h1 {
      font-size: clamp(2.2rem, 4vw, 3.2rem);
      font-weight: 700;
      line-height: 1.1;
      color: var(--gray-800);
      letter-spacing: -0.02em;
    }
    .left h1 span { color: var(--accent-dark); }

    .left p.sub {
      margin-top: 18px;
      font-size: 1rem;
      color: rgba(26,58,52,0.72);
      max-width: 380px;
      line-height: 1.65;
    }

    .leaf-float {
      position: absolute;
      opacity: 0.08;
      pointer-events: none;
      animation: floatLeaf 6s ease-in-out infinite alternate;
    }
    .leaf-float:nth-child(1) { bottom: 200px; right: 80px;  width: 48px; animation-delay: 0s; }
    .leaf-float:nth-child(2) { top: 260px;    right: 40px;  width: 36px; animation-delay: 1.5s; }
    .leaf-float:nth-child(3) { bottom: 80px;  right: 160px; width: 28px; animation-delay: 3s; }
    @keyframes floatLeaf {
      from { transform: translateY(0) rotate(-10deg); }
      to   { transform: translateY(-18px) rotate(10deg); }
    }

    /* ── RIGHT ── */
    .right {
      background: var(--white);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 48px;
      border-left: 1px solid rgba(118,234,208,0.3);
    }

    /* logo inline row */
    .logo-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 32px;
    }
    .logo-icon {
      width: 38px; height: 38px;
      background: linear-gradient(135deg, var(--teal), var(--sky));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 14px rgba(118,234,208,0.5);
    }
    .logo-icon svg { width: 20px; height: 20px; }
    .logo-name {
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--gray-800);
      letter-spacing: -0.01em;
    }

    .card {
      width: 100%;
      max-width: 380px;
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: 20px;
      padding: 36px 32px 28px;
      box-shadow: 0 4px 32px rgba(118,234,208,0.18);
    }

    /* lock icon circle */
    .lock-wrap {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }
    .lock-circle {
      width: 64px; height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(118,234,208,0.25), rgba(118,215,234,0.2));
      border: 2px solid rgba(118,234,208,0.4);
      display: flex; align-items: center; justify-content: center;
    }
    .lock-circle svg { width: 28px; height: 28px; color: var(--accent-dark); }

    .card h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gray-800);
      text-align: center;
      letter-spacing: -0.02em;
      margin-bottom: 8px;
    }
    .card .tagline {
      text-align: center;
      color: var(--gray-600);
      font-size: 0.875rem;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .field { margin-bottom: 20px; }
    .field label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--gray-800);
      margin-bottom: 6px;
      letter-spacing: 0.01em;
    }
    .input-wrap { position: relative; display: flex; align-items: center; }
    .input-wrap .ico {
      position: absolute; left: 14px;
      color: var(--gray-400);
      display: flex; align-items: center;
    }
    .input-wrap .ico svg { width: 16px; height: 16px; }
    .input-wrap input {
      width: 100%;
      padding: 12px 14px 12px 42px;
      border: 1.5px solid var(--gray-200);
      border-radius: 12px;
      background: var(--white);
      font-family: 'Inter', sans-serif;
      font-size: 0.875rem;
      color: var(--gray-800);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-wrap input::placeholder { color: var(--gray-400); }
    .input-wrap input:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 3px rgba(118,234,208,0.28);
    }
    .input-wrap input.invalid {
      border-color: var(--error);
      box-shadow: 0 0 0 3px rgba(224,85,85,0.13);
    }

    .err-msg {
      display: none;
      margin-top: 5px;
      font-size: 0.775rem;
      color: var(--error);
      align-items: center;
      gap: 4px;
      font-weight: 500;
    }
    .err-msg svg { width: 13px; height: 13px; flex-shrink: 0; }
    .err-msg.show { display: flex; }

    /* success state */
    .success-box {
      display: none;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 8px 0 16px;
      gap: 12px;
    }
    .success-box.show { display: flex; }
    .success-icon {
      width: 56px; height: 56px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(153,255,153,0.35), rgba(118,234,208,0.3));
      border: 2px solid rgba(118,234,208,0.5);
      display: flex; align-items: center; justify-content: center;
    }
    .success-icon svg { width: 26px; height: 26px; color: var(--accent-dark); }
    .success-box h3 { font-size: 1rem; font-weight: 700; color: var(--gray-800); }
    .success-box p  { font-size: 0.85rem; color: var(--gray-600); line-height: 1.55; }

    .btn-send {
      width: 100%; padding: 13px; border: none; border-radius: 12px;
      background: linear-gradient(90deg, var(--teal) 0%, var(--sky) 50%, var(--green) 100%);
      color: var(--gray-800);
      font-family: 'Inter', sans-serif;
      font-size: 0.95rem; font-weight: 700; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      box-shadow: 0 4px 18px rgba(118,234,208,0.5);
      transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
      margin-bottom: 16px;
    }
    .btn-send:hover  { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(118,234,208,0.55); }
    .btn-send:active { transform: translateY(0); opacity: 1; }
    .btn-send svg { width: 16px; height: 16px; }

    .back-link {
      display: flex; align-items: center; justify-content: center; gap: 6px;
      font-size: 0.875rem; color: var(--gray-600);
      text-decoration: none; font-weight: 500;
      transition: color 0.2s;
      margin-bottom: 24px;
    }
    .back-link:hover { color: var(--accent-dark); }
    .back-link svg { width: 15px; height: 15px; }

    .hint-box {
      border-top: 1px solid var(--gray-200);
      padding-top: 18px;
      font-size: 0.8rem;
      color: var(--gray-400);
      text-align: center;
      line-height: 1.55;
    }

    @media (max-width: 820px) {
      .page { grid-template-columns: 1fr; }
      .left { display: none; }
      .right { padding: 36px 24px; justify-content: flex-start; padding-top: 60px; }
    }
  </style>
</head>
<body>
<div class="page">

  <!-- LEFT -->
  <div class="left">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="blob blob-4"></div>

    <svg class="leaf-float" viewBox="0 0 60 60" fill="none"><path d="M30 5C30 5 10 20 10 35C10 46 20 55 30 55C40 55 50 46 50 35C50 20 30 5 30 5Z" fill="#1f7a62"/><line x1="30" y1="55" x2="30" y2="20" stroke="#1f7a62" stroke-width="2"/></svg>
    <svg class="leaf-float" viewBox="0 0 60 60" fill="none"><path d="M30 5C30 5 10 20 10 35C10 46 20 55 30 55C40 55 50 46 50 35C50 20 30 5 30 5Z" fill="#1f7a62"/><line x1="30" y1="55" x2="30" y2="20" stroke="#1f7a62" stroke-width="2"/></svg>
    <svg class="leaf-float" viewBox="0 0 60 60" fill="none"><path d="M30 5C30 5 10 20 10 35C10 46 20 55 30 55C40 55 50 46 50 35C50 20 30 5 30 5Z" fill="#1f7a62"/><line x1="30" y1="55" x2="30" y2="20" stroke="#1f7a62" stroke-width="2"/></svg>

    <div class="left-inner">
      <div class="icon-row">
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1f7a62" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C12 2 5 8 5 14a7 7 0 0014 0C19 8 12 2 12 2z"/><line x1="12" y1="21" x2="12" y2="10"/></svg>
        </div>
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1f7a62" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8C8 10 5.9 16.17 3.82 19.34a1 1 0 001.66 1.12C7.71 17.3 12 15 20 16"/><path d="M3 22s1-1 2-2"/></svg>
        </div>
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1f7a62" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M2 12h3M19 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12"/></svg>
        </div>
      </div>

      <h1>Reset Your<br/><span>Password</span></h1>
      <p class="sub">Enter your email address and we will send you a reset link.</p>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="right">

    <!-- logo inline -->
    <div class="logo-row">
      <div class="logo-icon">
        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <line x1="16" y1="30" x2="16" y2="14" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
          <path d="M16 20 C16 20 7 17 6 9 C6 9 14 8 16 16" fill="white"/>
          <path d="M16 14 C16 14 25 11 26 3 C26 3 18 2 16 10" fill="white"/>
        </svg>
      </div>
      <span class="logo-name">Sproutly</span>
    </div>

    <div class="card">

      <!-- lock icon -->
      <div class="lock-wrap">
        <div class="lock-circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0110 0v4"/>
          </svg>
        </div>
      </div>

      <h2>Forgot your password?</h2>
      <p class="tagline">No worries! Just enter your email address below and we'll send you a link to reset your password.</p>

      <!-- form area (hidden when success) -->
      <div id="form-area">
        <div class="field">
          <label for="email">Email Address</label>
          <div class="input-wrap">
            <span class="ico">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
            </span>
            <input id="email" type="email" name="email" autocomplete="email" placeholder="you@example.com"/>
          </div>
          <div class="err-msg" id="email-err">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>Email wajib diisi.</span>
          </div>
        </div>

        <button class="btn-send" id="btn-send" type="button">
          Send Reset Link
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </button>
      </div>

      <!-- success state -->
      <div class="success-box" id="success-box">
        <div class="success-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h3>Email terkirim!</h3>
        <p>Cek inbox kamu. Link reset password sudah dikirim ke <strong id="sent-email"></strong></p>
      </div>

      <a class="back-link" href="sproutly-login.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Back to Login
      </a>

      <div class="hint-box">
        If you don't receive an email within 5 minutes, check your spam folder or contact our support team.
      </div>
    </div>
  </div>
</div>

<script>
  const emailInput = document.getElementById('email');
  const emailErr   = document.getElementById('email-err');
  const formArea   = document.getElementById('form-area');
  const successBox = document.getElementById('success-box');
  const sentEmail  = document.getElementById('sent-email');

  function showErr(msg) {
    emailInput.classList.add('invalid');
    emailErr.querySelector('span').textContent = msg;
    emailErr.classList.add('show');
  }
  function clearErr() {
    emailInput.classList.remove('invalid');
    emailErr.classList.remove('show');
  }

  emailInput.addEventListener('input', clearErr);

  document.getElementById('btn-send').addEventListener('click', () => {
    const val = emailInput.value.trim();
    if (!val) {
      showErr('Email wajib diisi.');
      return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
      showErr('Format email tidak valid.');
      return;
    }
    clearErr();

    // show success
    sentEmail.textContent = val;
    formArea.style.display = 'none';
    successBox.classList.add('show');
  });
</script>
</body>
</html>