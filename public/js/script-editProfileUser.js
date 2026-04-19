/* =====================
   SIDEBAR TOGGLE
===================== */
(function () {
  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");
  const overlay       = document.getElementById("sidebarOverlay");
  const sidebarToggle = document.getElementById("sidebarToggle");

  if (!sidebar || !sidebarToggle) return;

  const MOBILE_BP = 768;

  function isMobile() {
    return window.innerWidth <= MOBILE_BP;
  }

  function openSidebar() {
    sidebar.classList.remove("closed");
    sidebarToggle.classList.add("is-open");

    if (isMobile()) {
      // Mobile: pakai overlay, tidak push layout
      if (overlay) {
        overlay.style.display = "block";
        requestAnimationFrame(() => overlay.classList.add("active"));
      }
    } else {
      // Desktop: push layout ke kanan
      if (mainContent) mainContent.classList.add("pushed");
    }

    document.body.classList.add("sidebar-open");
  }

  function closeSidebar() {
    sidebar.classList.add("closed");
    sidebarToggle.classList.remove("is-open");

    // Tutup overlay (mobile)
    if (overlay) {
      overlay.classList.remove("active");
      setTimeout(() => { overlay.style.display = "none"; }, 260);
    }

    // Kembalikan layout (desktop)
    if (mainContent) mainContent.classList.remove("pushed");

    document.body.classList.remove("sidebar-open");
  }

  function isSidebarOpen() {
    return !sidebar.classList.contains("closed");
  }

  // ── Init: sidebar tertutup saat halaman dibuka ──
  sidebar.classList.add("closed");
  if (overlay) overlay.style.display = "none";

  // ── Burger toggle ──
  sidebarToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    isSidebarOpen() ? closeSidebar() : openSidebar();
  });

  // ── Klik overlay (mobile) → tutup ──
  if (overlay) {
    overlay.addEventListener("click", () => closeSidebar());
  }

  // ── Klik di luar sidebar (desktop) → tutup ──
  document.addEventListener("click", (e) => {
    if (
      !isMobile() &&
      isSidebarOpen() &&
      !sidebar.contains(e.target) &&
      !sidebarToggle.contains(e.target)
    ) {
      closeSidebar();
    }
  });

  // ── Klik link di sidebar → tutup (UX) ──
  document.querySelectorAll(".sidebar-menu .menu-link").forEach((link) => {
    link.addEventListener("click", () => closeSidebar());
  });

  // ── Resize: sesuaikan behaviour ──
  window.addEventListener("resize", () => {
    if (isSidebarOpen()) {
      if (isMobile()) {
        if (mainContent) mainContent.classList.remove("pushed");
        if (overlay) {
          overlay.style.display = "block";
          requestAnimationFrame(() => overlay.classList.add("active"));
        }
      } else {
        if (overlay) {
          overlay.classList.remove("active");
          setTimeout(() => { overlay.style.display = "none"; }, 260);
        }
        if (mainContent) mainContent.classList.add("pushed");
      }
    }
  });
})();

/* =====================
   AVATAR PHOTO PREVIEW
===================== */
const photoInput = document.getElementById('photoInput');
const avatarImg  = document.getElementById('avatarImg');
const removeBtn  = document.getElementById('removePhoto');

const DEFAULT_AVATAR = avatarImg ? avatarImg.src : '';

if (photoInput && avatarImg) {
  photoInput.addEventListener('change', () => {
    const file = photoInput.files[0];
    if (!file) return;

    if (!file.type.startsWith('image/')) {
      alert('Please select a valid image file.');
      photoInput.value = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = e => {
      avatarImg.src = e.target.result;
      avatarImg.style.borderColor = 'var(--teal, #76ead0)';
    };
    reader.readAsDataURL(file);
  });
}

if (removeBtn && avatarImg) {
  removeBtn.addEventListener('click', () => {
    avatarImg.src = DEFAULT_AVATAR;
    if (photoInput) photoInput.value = '';
    avatarImg.style.borderColor = '';
  });
}

/* =====================
   SELECT placeholder color
===================== */
const genderSelect = document.getElementById('gender');
if (genderSelect) {
  const syncColor = () => {
    genderSelect.style.color = genderSelect.value ? '#1e2a28' : '#8a9eaa';
  };
  genderSelect.addEventListener('change', syncColor);
  syncColor();
}

/* =====================
   CLIENT-SIDE VALIDATION
===================== */
const form = document.querySelector('.edit-form');

if (form) {
  form.addEventListener('submit', e => {
    let valid = true;

    // Clear previous JS errors
    form.querySelectorAll('.js-error').forEach(el => el.remove());
    form.querySelectorAll('.form-input').forEach(el => el.classList.remove('is-error'));

    form.querySelectorAll('.form-input[required]').forEach(input => {
      if (!input.value.trim()) {
        markError(input, 'This field is required.');
        valid = false;
      }
    });

    // Email format check
    const emailInput = document.getElementById('email');
    if (emailInput && emailInput.value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        markError(emailInput, 'Please enter a valid email address.');
        valid = false;
      }
    }

    if (!valid) {
      e.preventDefault();
      const firstErr = form.querySelector('.is-error');
      if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  form.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', () => clearError(input));
    input.addEventListener('change', () => clearError(input));
  });
}

function markError(input, message) {
  input.classList.add('is-error');
  if (!input.closest('.form-group').querySelector('.js-error')) {
    const span = document.createElement('span');
    span.className = 'field-error js-error';
    span.textContent = message;
    input.closest('.form-group').appendChild(span);
  }
}

function clearError(input) {
  if (input.value.trim()) {
    input.classList.remove('is-error');
    const jsErr = input.closest('.form-group').querySelector('.js-error');
    if (jsErr) jsErr.remove();
  }
}