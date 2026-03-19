/* =====================
   SIDEBAR TOGGLE
===================== */
const sidebar        = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const sidebarToggle  = document.getElementById('sidebarToggle');

function openSidebar() {
  sidebar.classList.add('open');
  sidebarOverlay.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeSidebar() {
  sidebar.classList.remove('open');
  sidebarOverlay.classList.remove('active');
  document.body.style.overflow = '';
}

if (sidebarToggle) {
  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
  });
}

if (sidebarOverlay) {
  sidebarOverlay.addEventListener('click', closeSidebar);
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeSidebar();
});

document.querySelectorAll('.sidebar-link').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 1024) closeSidebar();
  });
});

/* =====================
   AVATAR PHOTO PREVIEW
===================== */
const photoInput    = document.getElementById('photoInput');
const avatarImg     = document.getElementById('avatarImg');
const removeBtn     = document.getElementById('removePhoto');
const DEFAULT_SRC   = avatarImg ? avatarImg.src : '';

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
    avatarImg.src           = DEFAULT_SRC;
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

    // Clear previous JS errors
    form.querySelectorAll('.js-err').forEach(el => el.remove());
    form.querySelectorAll('.form-input').forEach(el => el.classList.remove('is-error'));

    // Required fields
    form.querySelectorAll('.form-input[required]').forEach(input => {
      if (!input.value.trim()) {
        markError(input, 'This field is required.');
        valid = false;
      }
    });

    // Email format
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

  // Clear on input
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
    span.className  = 'field-error js-err';
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