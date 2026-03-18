/* =====================
   PASSWORD TOGGLE
===================== */
document.querySelectorAll('.toggle-pw').forEach(btn => {
  btn.addEventListener('click', () => {
    const targetId = btn.dataset.target;
    const input    = document.getElementById(targetId);
    if (!input) return;

    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';

    // Swap eye icon appearance
    const icon = btn.querySelector('.eye-icon');
    if (icon) {
      icon.style.opacity = isHidden ? '1' : '0.45';
    }
    btn.style.color = isHidden ? 'var(--teal, #76ead0)' : '';
  });
});

/* =====================
   CLIENT-SIDE VALIDATION
===================== */
const form = document.querySelector('.register-form');

if (form) {
  form.addEventListener('submit', e => {
    let valid = true;

    // Clear previous states
    form.querySelectorAll('.form-input').forEach(el => {
      el.classList.remove('is-error');
    });
    form.querySelectorAll('.js-error').forEach(el => el.remove());

    // Required fields check
    form.querySelectorAll('.form-input[required]').forEach(input => {
      if (!input.value.trim()) {
        markError(input, 'This field is required.');
        valid = false;
      }
    });

    // Password match
    const pw  = document.getElementById('password');
    const cpw = document.getElementById('password_confirmation');
    if (pw && cpw && pw.value && cpw.value && pw.value !== cpw.value) {
      markError(cpw, 'Passwords do not match.');
      valid = false;
    }

    // Password length
    if (pw && pw.value && pw.value.length < 8) {
      markError(pw, 'Password must be at least 8 characters.');
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      const firstErr = form.querySelector('.is-error');
      if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Clear error on input/change
  form.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', () => clearError(input));
    input.addEventListener('change', () => clearError(input));
  });
}

function markError(input, message) {
  input.classList.add('is-error');
  // Only inject if no server-side error already present
  if (!input.parentElement.querySelector('.field-error')) {
    const span = document.createElement('span');
    span.className = 'field-error js-error';
    span.textContent = message;
    input.parentElement.appendChild(span);
  }
}

function clearError(input) {
  if (input.value.trim()) {
    input.classList.remove('is-error');
    const jsErr = input.parentElement.querySelector('.js-error');
    if (jsErr) jsErr.remove();
  }
}

/* =====================
   SELECT placeholder color
===================== */
const genderSelect = document.getElementById('gender');
if (genderSelect) {
  const setColor = () => {
    genderSelect.style.color = genderSelect.value ? '#2d2d2d' : '#7a8a9a';
  };
  genderSelect.addEventListener('change', setColor);
  setColor(); // init
}