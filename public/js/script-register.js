/* ==============================================
   script-register.js
   Handles:
   - Role toggle (User ↔ Expert)
   - Password visibility toggle
   - File upload label update
   - Left panel content swap
============================================== */

document.addEventListener('DOMContentLoaded', function () {

  /* ---- Elements ---- */
  const btnUser       = document.getElementById('btnUser');
  const btnExpert     = document.getElementById('btnExpert');
  const toggleSlider  = document.getElementById('toggleSlider');

  const formUser      = document.getElementById('formUser');
  const formExpert    = document.getElementById('formExpert');

  const leftUser      = document.getElementById('leftUser');
  const leftExpert    = document.getElementById('leftExpert');
  const decoEmoji     = document.getElementById('decoEmoji');

  const formTitle     = document.getElementById('formTitle');
  const formSubtitle  = document.getElementById('formSubtitle');

  const certFile      = document.getElementById('certFile');
  const uploadText    = document.getElementById('uploadText');

  /* ---- Role Switch ---- */
  function switchToUser() {
    // Slider
    toggleSlider.classList.remove('slide-right');

    // Button states
    btnUser.classList.add('toggle-btn--active');
    btnExpert.classList.remove('toggle-btn--active');

    // Forms
    formUser.classList.remove('register-form--hidden');
    formExpert.classList.add('register-form--hidden');

    // Left panel
    leftUser.classList.remove('left-content--hidden');
    leftExpert.classList.add('left-content--hidden');
    decoEmoji.textContent = '🌱';

    // Headings
    formTitle.textContent    = 'Create Account';
    formSubtitle.textContent = 'Start your plant consultation journey';
  }

  function switchToExpert() {
    // Slider
    toggleSlider.classList.add('slide-right');

    // Button states
    btnExpert.classList.add('toggle-btn--active');
    btnUser.classList.remove('toggle-btn--active');

    // Forms
    formExpert.classList.remove('register-form--hidden');
    formUser.classList.add('register-form--hidden');

    // Left panel
    leftExpert.classList.remove('left-content--hidden');
    leftUser.classList.add('left-content--hidden');
    decoEmoji.textContent = '🌿';

    // Headings
    formTitle.textContent    = 'Register as Botanist Expert';
    formSubtitle.textContent = 'Create your expert account to start helping plant owners';
  }

  btnUser.addEventListener('click', switchToUser);
  btnExpert.addEventListener('click', switchToExpert);

  /* ---- Password Visibility Toggle ---- */
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.toggle-pw');
    if (!btn) return;

    const targetId = btn.dataset.target;
    const input = document.getElementById(targetId);
    if (!input) return;

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    // Swap eye icon
    const svg = btn.querySelector('svg');
    if (svg) {
      if (isPassword) {
        // Show "eye-off" state — add a slash line
        svg.innerHTML = `
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
          <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
          <line x1="1" y1="1" x2="23" y2="23"/>
        `;
      } else {
        svg.innerHTML = `
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>
        `;
      }
    }
  });

  /* ---- File Upload Label Update ---- */
  if (certFile && uploadText) {
    certFile.addEventListener('change', function () {
      if (certFile.files && certFile.files.length > 0) {
        uploadText.textContent = certFile.files[0].name;
      } else {
        uploadText.textContent = 'Upload certification document (PDF, JPG, PNG)';
      }
    });
  }
  const activeRole = document.body.dataset.activeRole;

  if (activeRole === 'expert') {
  switchToExpert();
    } else {
  switchToUser();
    } 

});