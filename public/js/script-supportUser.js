document.addEventListener('DOMContentLoaded', function () {

  // ── Sidebar (exact dashboard-user pattern) ───────────────────
  var menuToggle  = document.getElementById('menuToggle');
  var sidebar     = document.getElementById('sidebar');
  var mainContent = document.getElementById('mainContent');

  function openSidebar() {
    if (window.innerWidth <= 768) { sidebar.classList.add('show'); sidebar.classList.remove('closed'); }
    else { sidebar.classList.remove('closed'); mainContent.classList.add('shifted'); mainContent.classList.remove('full'); }
  }
  function closeSidebar() {
    sidebar.classList.add('closed'); sidebar.classList.remove('show');
    mainContent.classList.remove('shifted'); mainContent.classList.add('full');
  }
  function isSidebarOpen() {
    return window.innerWidth <= 768 ? sidebar.classList.contains('show') : !sidebar.classList.contains('closed');
  }
  menuToggle.addEventListener('click', function () { isSidebarOpen() ? closeSidebar() : openSidebar(); });
  document.querySelectorAll('.menu-link').forEach(function (l) { l.addEventListener('click', closeSidebar); });
  document.addEventListener('click', function (e) {
    if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
  });
  window.addEventListener('resize', function () {
    if (window.innerWidth > 768) sidebar.classList.remove('show');
    else { mainContent.classList.remove('shifted'); mainContent.classList.add('full'); }
  });

  // ── Report Modal ──────────────────────────────────────────────
  var reportModal = document.getElementById('reportModal');
  var ctaBtn      = document.getElementById('ctaBtn');
  var modalClose  = document.getElementById('modalClose');
  var submitBtn   = document.getElementById('submitReport');
  var uploadZone  = document.getElementById('uploadZone');
  var fileInput   = document.getElementById('fileInput');

  function openModal() { reportModal.classList.remove('hidden'); }
  function closeModal() {
    reportModal.classList.add('hidden');
    // Reset form
    document.getElementById('issueTitle').value = '';
    document.getElementById('issueDesc').value  = '';
    document.getElementById('uploadInner').innerHTML =
      '<svg viewBox="0 0 24 24" fill="none" width="36" height="36">' +
        '<path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/>' +
        '<polyline points="17 8 12 3 7 8" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>' +
        '<line x1="12" y1="3" x2="12" y2="15" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/>' +
      '</svg>' +
      '<p>Tap to upload screenshot</p>' +
      '<span>PNG, JPG up to 5MB</span>';
  }

  if (ctaBtn)     ctaBtn.addEventListener('click', openModal);
  if (modalClose) modalClose.addEventListener('click', closeModal);
  reportModal.addEventListener('click', function (e) { if (e.target === reportModal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

  // File upload
  uploadZone.addEventListener('click', function () { fileInput.click(); });
  fileInput.addEventListener('change', function () {
    if (!fileInput.files || !fileInput.files[0]) return;
    var file = fileInput.files[0];
    if (file.size > 5 * 1024 * 1024) { alert('File size exceeds 5MB. Please choose a smaller file.'); return; }
    var inner = document.getElementById('uploadInner');
    inner.innerHTML =
      '<i class="fa-solid fa-image" style="font-size:28px;color:#76ead0;margin-bottom:8px"></i>' +
      '<p style="color:#2d3a48;font-weight:600">' + file.name + '</p>' +
      '<span>' + (file.size / 1024).toFixed(1) + ' KB — click to change</span>';
  });

  // Submit with inline validation
  submitBtn.addEventListener('click', function () {
    var titleInput = document.getElementById('issueTitle');
    var descInput  = document.getElementById('issueDesc');
    var titleError = document.getElementById('titleError');
    var descError  = document.getElementById('descError');
    var title = titleInput.value.trim();
    var desc  = descInput.value.trim();
    var valid = true;

    // Reset errors
    titleInput.classList.remove('input-error');
    descInput.classList.remove('input-error');
    titleError.classList.add('hidden');
    descError.classList.add('hidden');

    if (!title) {
      titleInput.classList.add('input-error');
      titleError.classList.remove('hidden');
      valid = false;
    }
    if (!desc) {
      descInput.classList.add('input-error');
      descError.classList.remove('hidden');
      valid = false;
    }
    if (!valid) return;

    closeModal();
    showToast();
  });

  // Clear error on input
  document.getElementById('issueTitle').addEventListener('input', function () {
    this.classList.remove('input-error');
    document.getElementById('titleError').classList.add('hidden');
  });
  document.getElementById('issueDesc').addEventListener('input', function () {
    this.classList.remove('input-error');
    document.getElementById('descError').classList.add('hidden');
  });

  // ── Toast ─────────────────────────────────────────────────────
  function showToast() {
    var toast = document.getElementById('successToast');
    toast.classList.remove('hidden');
    setTimeout(function () {
      toast.style.animation = 'toastOut 0.25s ease forwards';
      setTimeout(function () { toast.classList.add('hidden'); toast.style.animation = ''; }, 260);
    }, 3500);
  }
  var toastClose = document.getElementById('toastClose');
  if (toastClose) toastClose.addEventListener('click', function () {
    document.getElementById('successToast').classList.add('hidden');
  });

  // ── Scroll reveal ─────────────────────────────────────────────
  document.querySelectorAll('.faq-card').forEach(function (el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(14px)';
    el.style.transition = 'opacity 0.36s ease ' + (i * 0.06) + 's, transform 0.32s ease ' + (i * 0.06) + 's, box-shadow 0.18s, transform 0.14s';
  });
  document.querySelectorAll('.rules-card, .cta-card').forEach(function (el) {
    el.style.opacity = '0';
    el.style.transition = 'opacity 0.4s ease 0.1s';
  });

  function revealOnScroll() {
    document.querySelectorAll('.faq-card, .rules-card, .cta-card').forEach(function (el) {
      if (el.getBoundingClientRect().top < window.innerHeight - 60) {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      }
    });
  }
  window.addEventListener('scroll', revealOnScroll, { passive: true });
  revealOnScroll();

});