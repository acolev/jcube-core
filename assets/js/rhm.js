HTMLElement.prototype.RHM = function (label = 'Other', stop = 'xs') {
  const RW = {xs: 0, sm: 576, md: 768, lg: 992, xl: 1200, xxl: 1400};
  const tw = label.length * 10;

  function renderDropDownMenu() {
    const other = document.createElement('li');
    other.setAttribute('data-menu-other', true);
    other.classList.add('nav-item');
    const otherLink = document.createElement('a');
    otherLink.setAttribute('href', 'javascript:void(0)');
    otherLink.classList.add('dropdown-toggle', 'menu-link', 'nav-link');
    otherLink.setAttribute('data-bs-toggle', 'dropdown');
    otherLink.setAttribute('aria-expanded', 'false');
    otherLink.append(label)
    const otherList = document.createElement('ul');
    otherList.classList.add('dropdown-menu', 'text-nowrap');

    other.appendChild(otherLink)
    other.appendChild(otherList)

    return other;
  }

  const reset = () => {
    for (const el of this.children) {
      el.removeAttribute('hidden')
    }
    document.querySelector('[data-menu-other]')?.remove();
  }

  const move = () => {
    if (window.innerWidth <= RW[stop]) return;
    const cw = this.parentNode?.clientWidth;
    let mw = 0;
    let c = 0;
    const other = renderDropDownMenu();
    const drop = other.querySelector('ul');

    for (const el of this.children) {
      mw += el.clientWidth
      const pos = cw - mw - el.clientWidth - tw;

      if (pos <= 0) {
        drop.append(el.cloneNode(true));
        el.setAttribute('hidden', true);
        c++;
      }
    }
    if (c) this.append(other);
  }

  reset();
  move();
  window.addEventListener('resize', () => {
    reset();
    move();
  })
}
