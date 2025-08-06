/**
 * Smooth Scroll Component
 * 
 * Handles smooth scrolling to anchor links
 */
export const smoothScroll = {
  init() {
    this.initAnchorLinks()
    this.initScrollToTop()
  },
  
  /**
   * Initialize anchor links
   */
  initAnchorLinks() {
    // Get all anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])')
    
    // Add click event listener to each anchor link
    anchorLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        // Get the target element
        const targetId = link.getAttribute('href')
        const targetElement = document.querySelector(targetId)
        
        // If target element exists, scroll to it
        if (targetElement) {
          e.preventDefault()
          this.scrollToElement(targetElement, link.dataset.offset)
        }
      })
    })
  },
  
  /**
   * Initialize scroll to top button
   */
  initScrollToTop() {
    // Get scroll to top button
    const scrollToTopButton = document.querySelector('.scroll-to-top')
    
    // If button exists, add click event listener
    if (scrollToTopButton) {
      scrollToTopButton.addEventListener('click', (e) => {
        e.preventDefault()
        this.scrollToTop()
      })
      
      // Show/hide button based on scroll position
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          scrollToTopButton.classList.add('active')
        } else {
          scrollToTopButton.classList.remove('active')
        }
      })
    }
  },
  
  /**
   * Scroll to element
   * 
   * @param {HTMLElement} element - The element to scroll to
   * @param {number} offset - The offset from the top of the element
   */
  scrollToElement(element, offset = 0) {
    // Get element position
    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset
    
    // Calculate scroll position
    const offsetValue = parseInt(offset) || 0
    const scrollPosition = elementPosition - offsetValue
    
    // Scroll to element
    window.scrollTo({
      top: scrollPosition,
      behavior: 'smooth'
    })
    
    // Update URL hash
    const elementId = element.getAttribute('id')
    if (elementId) {
      window.history.pushState(null, null, `#${elementId}`)
    }
  },
  
  /**
   * Scroll to top
   */
  scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    })
  }
}