document.addEventListener('DOMContentLoaded', () => {
  const shell = document.querySelector('.site-shell');

  if (shell) {
    const sky = document.createElement('div');
    sky.className = 'night-sky';
    sky.setAttribute('aria-hidden', 'true');
    sky.innerHTML = `
      <span class="moon"><i></i></span>
      <span class="cloud-layer"></span>
      <span class="cloud cloud-one"></span>
      <span class="cloud cloud-two"></span>
      <span class="cloud cloud-three"></span>
      <span class="diamond-star diamond-star-one"></span>
      <span class="diamond-star diamond-star-two"></span>
      <span class="diamond-star diamond-star-three"></span>
      <span class="diamond-star diamond-star-four"></span>
      <span class="diamond-star diamond-star-five"></span>
      <span class="diamond-star diamond-star-six"></span>
    `;
    shell.prepend(sky);

    const nav = document.querySelector('.main-nav');
    const header = document.querySelector('.site-header');

    if (nav && header && !header.querySelector('.menu-toggle')) {
      const toggle = document.createElement('button');
      toggle.className = 'menu-toggle';
      toggle.type = 'button';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-controls', 'main-navigation');
      toggle.setAttribute('aria-label', 'Open navigation');
      toggle.innerHTML = '<span></span><span></span><span></span>';
      nav.id = 'main-navigation';
      header.appendChild(toggle);

      toggle.addEventListener('click', () => {
        const open = nav.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
      });

      nav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
          nav.classList.remove('is-open');
          toggle.setAttribute('aria-expanded', 'false');
          toggle.setAttribute('aria-label', 'Open navigation');
        });
      });
    }
  }

  document.querySelectorAll('.notice').forEach((notice) => {
    window.setTimeout(() => notice.classList.add('is-hidden'), 6000);
  });

  const revealItems = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, observerInstance) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observerInstance.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    revealItems.forEach((item) => observer.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
  }

  const progress = document.createElement('div');
  progress.className = 'scroll-progress';
  progress.setAttribute('aria-hidden', 'true');
  document.body.appendChild(progress);

  const topButton = document.createElement('button');
  topButton.className = 'back-to-top';
  topButton.type = 'button';
  topButton.setAttribute('aria-label', 'Back to top');
  topButton.innerHTML = '↑';
  document.body.appendChild(topButton);

  const updateScrollUI = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const percentage = maxScroll > 0 ? (scrollTop / maxScroll) * 100 : 0;
    progress.style.setProperty('--scroll-progress', `${percentage}%`);
    topButton.classList.toggle('is-visible', scrollTop > 500);
  };

  window.addEventListener('scroll', updateScrollUI, { passive: true });
  updateScrollUI();

  topButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
