/**
 * Mobile Navigation Component
 * 
 * Handles the mobile menu toggle functionality
 */
export const mobileNavigation = {
  init() {
    const toggle = document.getElementById('mobile-menu-toggle')
    const menu = document.getElementById('mobile-menu')
    const closeBtn = document.getElementById('close-mobile-menu')
    
    if (!toggle || !menu) return
    
    // Open menu
    toggle.addEventListener('click', () => {
      this.openMenu(menu, toggle)
    })
    
    // Close menu
    closeBtn?.addEventListener('click', () => {
      this.closeMenu(menu, toggle)
    })
    
    // Close on link click
    menu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        this.closeMenu(menu, toggle)
      })
    })
    
    // Close on backdrop click
    document.addEventListener('click', (e) => {
      if (!toggle.contains(e.target) && !menu.contains(e.target) && menu.classList.contains('active')) {
        this.closeMenu(menu, toggle)
      }
    })
  },
  
  openMenu(menu, toggle) {
    menu.classList.add('active')
    toggle.classList.add('active')
    document.body.classList.add('menu-open', 'overflow-hidden')
    
    // Add backdrop
    const backdrop = document.createElement('div')
    backdrop.className = 'menu-backdrop'
    backdrop.id = 'menu-backdrop'
    document.body.appendChild(backdrop)
  },
  
  closeMenu(menu, toggle) {
    menu.classList.remove('active')
    toggle.classList.remove('active')
    document.body.classList.remove('menu-open', 'overflow-hidden')
    
    // Remove backdrop
    const backdrop = document.getElementById('menu-backdrop')
    if (backdrop) backdrop.remove()

    // Handle submenu toggles in mobile view
    const subMenuToggles = document.querySelectorAll('.nav-menu-mobile .menu-item-has-children > a')
    
    subMenuToggles.forEach(toggle => {
      // Create dropdown toggle button
      const dropdownToggle = document.createElement('button')
      dropdownToggle.className = 'submenu-toggle'
      dropdownToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>'
      
      toggle.parentNode.appendChild(dropdownToggle)
      
      // Toggle submenu on click
      dropdownToggle.addEventListener('click', (e) => {
        e.preventDefault()
        e.stopPropagation()
        
        const parent = toggle.parentNode
        const submenu = parent.querySelector('.sub-menu')
        
        if (submenu) {
          submenu.classList.toggle('active')
          dropdownToggle.classList.toggle('active')
        }
      })
      
      // Prevent default link behavior when has submenu
      toggle.addEventListener('click', (e) => {
        if (window.innerWidth < 1024) { // Only on mobile
          const parent = toggle.parentNode
          if (parent.querySelector('.sub-menu')) {
            e.preventDefault()
          }
        }
      })
    })
  }
}