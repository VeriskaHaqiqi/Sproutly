/* =====================
   SCROLL REVEAL
===================== */
const revealEls = document.querySelectorAll('.reveal');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });

revealEls.forEach(el => observer.observe(el));

/* =====================
   NAVBAR SCROLL EFFECT
===================== */
const navbar = document.querySelector('nav');

window.addEventListener('scroll', () => {
  if (window.scrollY > 30) {
    navbar.style.background = 'rgba(255,255,255,0.92)';
    navbar.style.boxShadow = '0 2px 20px rgba(30,80,30,0.10)';
  } else {
    navbar.style.background = 'rgba(255,255,255,0.75)';
    navbar.style.boxShadow = 'none';
  }
});