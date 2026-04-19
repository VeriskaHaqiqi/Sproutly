/* =====================
   SIDEBAR TOGGLE — push layout
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
const photoInput  = document.getElementById('photoInput');
const avatarImg   = document.getElementById('avatarImg');
const removeBtn   = document.getElementById('removePhoto');
const DEFAULT_SRC = avatarImg ? avatarImg.src : '';

if (photoInput && avatarImg) {
  photoInput.addEventListener('change', () => {
    const file = photoInput.files[0];
    if (!file) return;

    if (!file.type.startsWith('image/')) {
      showToast('Please select a valid image file (JPG, PNG, etc.)', 'error');
      photoInput.value = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = e => {
      avatarImg.src = e.target.result;
      avatarImg.style.borderColor = 'rgba(118,234,208,0.60)';
    };
    reader.readAsDataURL(file);
  });
}

if (removeBtn && avatarImg) {
  removeBtn.addEventListener('click', () => {
    avatarImg.src = DEFAULT_SRC;
    avatarImg.style.borderColor = '';
    if (photoInput) photoInput.value = '';
  });
}

/* =====================
   SELECT — placeholder colour
===================== */
const genderSelect = document.getElementById('gender');
if (genderSelect) {
  const syncColor = () => {
    genderSelect.style.color = genderSelect.value ? '#1e2a28' : '#8fa8a4';
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

    form.querySelectorAll('.js-err').forEach(el => el.remove());
    form.querySelectorAll('.form-input').forEach(el => el.classList.remove('is-error'));

    form.querySelectorAll('.form-input[required]').forEach(input => {
      if (!input.value.trim()) {
        markError(input, 'This field is required.');
        valid = false;
      }
    });

    const emailInput = document.getElementById('email');
    if (emailInput && emailInput.value.trim()) {
      const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRx.test(emailInput.value.trim())) {
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
    input.addEventListener('input',  () => clearError(input));
    input.addEventListener('change', () => clearError(input));
  });
}

function markError(input, message) {
  input.classList.add('is-error');
  const group = input.closest('.form-group');
  if (group && !group.querySelector('.js-err')) {
    const span = document.createElement('span');
    span.className   = 'field-error js-err';
    span.textContent = message;
    group.appendChild(span);
  }
}

function clearError(input) {
  if (input.value.trim()) {
    input.classList.remove('is-error');
    const group = input.closest('.form-group');
    if (group) {
      const jsErr = group.querySelector('.js-err');
      if (jsErr) jsErr.remove();
    }
  }
}

/* =====================
   SIMPLE TOAST HELPER
===================== */
function showToast(message, type = 'info') {
  const existing = document.getElementById('sp-toast');
  if (existing) existing.remove();

  const toast = document.createElement('div');
  toast.id = 'sp-toast';
  toast.textContent = message;
  Object.assign(toast.style, {
    position:     'fixed',
    bottom:       '28px',
    left:         '50%',
    transform:    'translateX(-50%)',
    background:   type === 'error' ? '#e05c5c' : '#76ead0',
    color:        type === 'error' ? '#fff'     : '#1a2e1a',
    padding:      '11px 24px',
    borderRadius: '50px',
    fontFamily:   'Inter, sans-serif',
    fontSize:     '0.86rem',
    fontWeight:   '600',
    boxShadow:    '0 4px 20px rgba(0,0,0,0.15)',
    zIndex:       '9999',
    opacity:      '0',
    transition:   'opacity .3s ease',
    whiteSpace:   'nowrap',
  });

  document.body.appendChild(toast);
  requestAnimationFrame(() => { toast.style.opacity = '1'; });
  setTimeout(() => {
    toast.style.opacity = '0';
    setTimeout(() => toast.remove(), 350);
  }, 3000);
}