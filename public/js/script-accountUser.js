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

function toggleSidebar() {
  sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
}

// Toggle on logo button click
if (sidebarToggle) {
  sidebarToggle.addEventListener('click', toggleSidebar);
}

// Close when clicking overlay
if (sidebarOverlay) {
  sidebarOverlay.addEventListener('click', closeSidebar);
}

// Close on Escape key
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeSidebar();
});

/* =====================
   SIDEBAR LINK — close on mobile nav
===================== */
document.querySelectorAll('.sidebar-link').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 1024) closeSidebar();
  });
});

/* =====================
   SCROLL REVEAL (account cards)
===================== */
const cards = document.querySelectorAll('.account-card');

const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      entry.target.style.animationDelay = `${i * 0.06}s`;
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.08 });

cards.forEach(card => observer.observe(card));