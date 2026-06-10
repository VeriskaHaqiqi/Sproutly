/* =====================
   FILE UPLOAD — show filename
===================== */
const certFile   = document.getElementById('certFile');
const uploadText = document.getElementById('uploadText');
const fileLabel  = document.getElementById('fileLabel');

if (certFile && uploadText) {
  certFile.addEventListener('change', () => {
    const file = certFile.files[0];
    if (file) {
      uploadText.textContent = file.name;
      uploadText.style.color = '#2d4a2d';
      uploadText.style.fontWeight = '700';
      fileLabel.style.borderColor = '#76ead0';
      fileLabel.style.background  = 'rgba(118,234,208,0.08)';
    } else {
      uploadText.textContent = 'Upload certification document (PDF, JPG, PNG)';
      uploadText.style.color = '';
      uploadText.style.fontWeight = '';
      fileLabel.style.borderColor = '';
      fileLabel.style.background  = '';
    }
  });
}

/* =====================
   FORM — client-side validation feedback
===================== */
const form = document.querySelector('.register-form');

if (form) {
  form.addEventListener('submit', (e) => {
    let valid = true;

    // Remove previous error states
    form.querySelectorAll('.form-input').forEach(input => {
      input.style.borderColor = '';
      input.style.boxShadow   = '';
    });

    // Check required fields
    form.querySelectorAll('.form-input[required]').forEach(input => {
      if (!input.value.trim()) {
        input.style.borderColor = '#ff6b6b';
        input.style.boxShadow   = '0 0 0 3px rgba(255,107,107,0.15)';
        valid = false;
      }
    });

    if (!valid) {
      e.preventDefault();
      // Scroll to first error
      const firstError = form.querySelector('.form-input[required][style]');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Clear error on input
  form.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', () => {
      if (input.value.trim()) {
        input.style.borderColor = '';
        input.style.boxShadow   = '';
      }
    });
  });
}

/* =====================
   INPUT FOCUS — teal ring
===================== */
document.querySelectorAll('.form-input').forEach(input => {
  input.addEventListener('focus', () => {
    input.style.borderColor = '#76ead0';
    input.style.boxShadow   = '0 0 0 3px rgba(118,234,208,0.20)';
  });
  input.addEventListener('blur', () => {
    if (!input.style.borderColor.includes('ff6b6b')) {
      input.style.borderColor = '';
      input.style.boxShadow   = '';
    }
  });
});