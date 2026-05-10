/* Loishvizo Boosting Solutions — Pergo Theme JS */

// Sidebar mobile toggle for logged-in users
function lvToggleSidebar() {
  var sb = document.querySelector('.lv-user-sidebar');
  if(sb) sb.classList.toggle('open');
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
  a.addEventListener('click', function(e) {
    var target = document.querySelector(this.getAttribute('href'));
    if(target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// Active nav link highlighting based on scroll
(function() {
  var sections = document.querySelectorAll('section[id]');
  if(!sections.length) return;
  window.addEventListener('scroll', function() {
    var pos = window.scrollY + 100;
    sections.forEach(function(sec) {
      var top = sec.offsetTop;
      var h = sec.offsetHeight;
      var link = document.querySelector('.lv-nav-menu a[href="#' + sec.id + '"]');
      if(link) {
        if(pos >= top && pos < top + h) {
          document.querySelectorAll('.lv-nav-menu a').forEach(function(l){ l.classList.remove('active'); });
          link.classList.add('active');
        }
      }
    });
  }, { passive: true });
})();
