// Hamburger menu toggle
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('bh-hamburger');
  const nav = document.getElementById('bh-nav');
  if (hamburger && nav) {
    hamburger.addEventListener('click', function() {
      nav.classList.toggle('open');
    });
  }

  // Sticky header shadow on scroll
  const header = document.getElementById('site-header');
  if (header) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        header.style.background = 'rgba(13,17,23,0.98)';
        header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4)';
      } else {
        header.style.background = 'rgba(13,17,23,0.75)';
        header.style.boxShadow = 'none';
      }
    });
  }
});
