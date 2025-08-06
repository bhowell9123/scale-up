/**
 * GoHighLevel Integration Component
 * 
 * Handles GoHighLevel integration for tracking, forms, and chat
 */
export const ghlIntegration = {
  init() {
    this.setupTracking()
    this.setupForms()
    this.setupChatWidget()
    this.setupPhoneTracking()
    this.setupButtonTracking()
  },
  
  /**
   * Set up GHL tracking
   */
  setupTracking() {
    // Initialize GHL config if not already set
    if (!window.ghlConfig) {
      window.ghlConfig = {
        locationId: '7DUwt2e161ox8kn5pDDU',
        source: 'website',
        campaign: 'smart_website_landing'
      }
    }
    
    // Track page views
    this.trackPageView()
    
    // Set up scroll depth tracking
    this.setupScrollDepthTracking()
  },
  
  /**
   * Track page view
   */
  trackPageView() {
    // Send page view data to GHL
    this.sendToGHL('page_view', {
      page: window.location.pathname,
      title: document.title,
      referrer: document.referrer,
      timestamp: new Date().toISOString()
    })
    
    // Track in Google Analytics if available
    if (typeof gtag !== 'undefined') {
      gtag('event', 'page_view', {
        page_title: document.title,
        page_location: window.location.href,
        custom_parameter: 'scaleup_marketing_site'
      })
    }
    
    // Track in Facebook Pixel if available
    if (typeof fbq !== 'undefined') {
      fbq('track', 'PageView')
    }
  },
  
  /**
   * Set up scroll depth tracking
   */
  setupScrollDepthTracking() {
    let scrollMarks = [25, 50, 75, 100]
    let marks = new Set()
    
    window.addEventListener('scroll', () => {
      const scrollPercent = this.getScrollPercent()
      
      scrollMarks.forEach(mark => {
        if (scrollPercent >= mark && !marks.has(mark)) {
          marks.add(mark)
          this.trackScrollDepth(mark)
        }
      })
    })
  },
  
  /**
   * Get scroll percentage
   * 
   * @returns {number} - Scroll percentage
   */
  getScrollPercent() {
    const h = document.documentElement
    const b = document.body
    const st = 'scrollTop'
    const sh = 'scrollHeight'
    
    return (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100
  },
  
  /**
   * Track scroll depth
   * 
   * @param {number} depth - Scroll depth percentage
   */
  trackScrollDepth(depth) {
    this.sendToGHL('scroll_depth', {
      depth: depth,
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    })
  },
  
  /**
   * Set up GHL forms
   */
  setupForms() {
    const forms = document.querySelectorAll('[data-ghl-form]')
    
    forms.forEach(form => {
      // Skip if already initialized
      if (form.dataset.ghlInitialized === 'true') return
      
      // Mark as initialized
      form.dataset.ghlInitialized = 'true'
      
      // Track form field interactions
      this.trackFormInteractions(form)
      
      // Handle form submission
      form.addEventListener('submit', (e) => {
        e.preventDefault()
        this.handleGhlFormSubmission(form)
      })
    })
  },
  
  /**
   * Track form field interactions
   * 
   * @param {HTMLFormElement} form - The form to track
   */
  trackFormInteractions(form) {
    const formId = form.id || form.dataset.ghlForm
    const fields = form.querySelectorAll('input, textarea, select')
    
    fields.forEach(field => {
      // Track field focus
      field.addEventListener('focus', () => {
        this.sendToGHL('form_field_focus', {
          form: formId,
          field: field.name,
          timestamp: new Date().toISOString()
        })
      })
      
      // Track field completion
      field.addEventListener('blur', () => {
        if (field.value.trim()) {
          this.sendToGHL('form_field_complete', {
            form: formId,
            field: field.name,
            timestamp: new Date().toISOString()
          })
        }
      })
    })
  },
  
  /**
   * Handle GHL form submission
   * 
   * @param {HTMLFormElement} form - The form to handle
   */
  async handleGhlFormSubmission(form) {
    // Get form data
    const formData = new FormData(form)
    const formType = form.dataset.ghlForm || 'general'
    
    // Show loading state
    this.setFormLoading(form, true)
    
    try {
      // Prepare data for GHL
      const ghlData = {
        firstName: formData.get('first_name'),
        lastName: formData.get('last_name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        companyName: formData.get('business_name'),
        website: formData.get('current_website'),
        customFields: {
          website_source: 'scaleup_marketing_website',
          lead_type: formType,
          current_website: formData.get('current_website'),
          pain_points: formData.get('message'),
          page_source: window.location.pathname
        },
        tags: ['website_lead', 'smart_website_interest'],
        source: 'website'
      }
      
      // Add package info if available
      if (formData.get('package')) {
        ghlData.customFields.selected_package = formData.get('package')
        ghlData.customFields.package_price = formData.get('package_price')
        ghlData.tags.push(`package_${formData.get('package').toLowerCase()}`)
      }
      
      // Submit to GHL
      const response = await this.submitToGHL(ghlData)
      
      if (response.success) {
        this.showFormSuccess(form, 'Thank you! We\'ll contact you within 24 hours with your free quote.')
        
        // Track conversion
        this.trackConversion(formType)
        
        // Redirect to thank you page or calendar
        if (formType === 'pricing') {
          setTimeout(() => {
            window.location.href = '/book-consultation'
          }, 2000)
        }
      } else {
        throw new Error(response.message || 'Submission failed')
      }
      
    } catch (error) {
      console.error('Form submission error:', error)
      this.showFormError(form, 'Something went wrong. Please try again or call us directly.')
    } finally {
      this.setFormLoading(form, false)
    }
  },
  
  /**
   * Submit data to GHL
   * 
   * @param {Object} data - The data to submit
   * @returns {Promise<Object>} - The response
   */
  async submitToGHL(data) {
    // Use GHL webhook or API endpoint
    const webhookUrl = window.GHL_FORM_ENDPOINT || 'https://hooks.leadconnectorhq.com/hooks/7DUwt2e161ox8kn5pDDU'
    
    try {
      const response = await fetch(webhookUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
      })
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      
      return await response.json()
    } catch (error) {
      console.error('GHL submission error:', error)
      
      // Fallback to simulated success for development
      if (process.env.NODE_ENV === 'development') {
        console.log('Development mode: Simulating successful submission')
        return { success: true }
      }
      
      throw error
    }
  },
  
  /**
   * Set form loading state
   * 
   * @param {HTMLFormElement} form - The form to set loading state on
   * @param {boolean} loading - Whether the form is loading
   */
  setFormLoading(form, loading) {
    const button = form.querySelector('button[type="submit"]')
    const btnText = button?.querySelector('.btn-text')
    const btnLoading = button?.querySelector('.btn-loading')
    
    if (button) {
      button.disabled = loading
      
      if (btnText && btnLoading) {
        if (loading) {
          btnText.classList.add('hidden')
          btnLoading.classList.remove('hidden')
        } else {
          btnText.classList.remove('hidden')
          btnLoading.classList.add('hidden')
        }
      } else {
        button.innerHTML = loading ? 'Submitting...' : (button.dataset.originalText || 'Submit')
      }
    }
    
    // Disable all form inputs
    form.querySelectorAll('input, textarea, select').forEach(input => {
      input.disabled = loading
    })
  },
  
  /**
   * Show form success message
   * 
   * @param {HTMLFormElement} form - The form to show message on
   * @param {string} message - The message to show
   */
  showFormSuccess(form, message) {
    const messageEl = form.querySelector('.form-message') || this.createMessageElement(form)
    messageEl.className = 'form-message p-4 rounded-lg bg-green-100 border border-green-300 text-green-800'
    messageEl.textContent = message
    messageEl.classList.remove('hidden')
    
    // Reset form
    form.reset()
    
    // Hide message after 5 seconds
    setTimeout(() => {
      messageEl.classList.add('hidden')
    }, 5000)
  },
  
  /**
   * Show form error message
   * 
   * @param {HTMLFormElement} form - The form to show message on
   * @param {string} message - The message to show
   */
  showFormError(form, message) {
    const messageEl = form.querySelector('.form-message') || this.createMessageElement(form)
    messageEl.className = 'form-message p-4 rounded-lg bg-red-100 border border-red-300 text-red-800'
    messageEl.textContent = message
    messageEl.classList.remove('hidden')
    
    // Hide message after 5 seconds
    setTimeout(() => {
      messageEl.classList.add('hidden')
    }, 5000)
  },
  
  /**
   * Create message element
   * 
   * @param {HTMLFormElement} form - The form to create message element for
   * @returns {HTMLElement} - The message element
   */
  createMessageElement(form) {
    const messageEl = document.createElement('div')
    messageEl.className = 'form-message hidden p-4 rounded-lg'
    form.appendChild(messageEl)
    return messageEl
  },
  
  /**
   * Set up chat widget
   */
  setupChatWidget() {
    // Check if chat widget is already loaded
    if (document.querySelector('script[data-widget-id]')) return
    
    // Set up chat widget configuration
    window.ghlChatConfig = {
      locationId: window.ghlConfig?.locationId || '7DUwt2e161ox8kn5pDDU',
      widgetId: '7DUwt2e161ox8kn5pDDU',
      customData: {
        source: 'website',
        page: window.location.pathname,
        campaign: window.ghlConfig?.campaign || 'smart_website_landing'
      }
    }
    
    // Load chat widget script
    const chatScript = document.createElement('script')
    chatScript.src = 'https://widgets.leadconnectorhq.com/chat-widget/loader.js'
    chatScript.setAttribute('data-widget-id', window.ghlChatConfig.widgetId)
    chatScript.setAttribute('data-location-id', window.ghlChatConfig.locationId)
    document.body.appendChild(chatScript)
  },
  
  /**
   * Set up phone tracking
   */
  setupPhoneTracking() {
    const phoneLinks = document.querySelectorAll('a[href^="tel:"]')
    
    phoneLinks.forEach(link => {
      // Skip if already initialized
      if (link.dataset.ghlInitialized === 'true') return
      
      // Mark as initialized
      link.dataset.ghlInitialized = 'true'
      
      link.addEventListener('click', () => {
        // Track phone click
        this.trackPhoneClick(link.href)
      })
    })
  },
  
  /**
   * Track phone click
   * 
   * @param {string} phoneNumber - The phone number
   */
  trackPhoneClick(phoneNumber) {
    // Extract phone number from href
    const number = phoneNumber.replace('tel:', '')
    
    // Send to GHL
    this.sendToGHL('phone_click', {
      phone: number,
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    })
    
    // Track in Google Analytics if available
    if (typeof gtag !== 'undefined') {
      gtag('event', 'phone_call', {
        event_category: 'engagement',
        event_label: number
      })
    }
  },
  
  /**
   * Set up button tracking
   */
  setupButtonTracking() {
    // Track CTA buttons
    const ctaButtons = document.querySelectorAll('.btn-primary, .btn-secondary, [data-track-click]')
    
    ctaButtons.forEach(button => {
      // Skip if already initialized
      if (button.dataset.ghlInitialized === 'true') return
      
      // Mark as initialized
      button.dataset.ghlInitialized = 'true'
      
      button.addEventListener('click', () => {
        // Get button data
        const buttonText = button.textContent.trim()
        const buttonType = button.dataset.trackClick || button.className.includes('btn-primary') ? 'primary' : 'secondary'
        
        // Track button click
        this.trackButtonClick(buttonText, buttonType)
      })
    })
    
    // Track package buttons
    const packageButtons = document.querySelectorAll('[data-package]')
    
    packageButtons.forEach(button => {
      // Skip if already initialized
      if (button.dataset.ghlInitialized === 'true') return
      
      // Mark as initialized
      button.dataset.ghlInitialized = 'true'
      
      button.addEventListener('click', (e) => {
        e.preventDefault()
        
        const packageName = button.dataset.package
        const packagePrice = button.dataset.price
        
        // Track package interest
        this.trackPackageInterest(packageName, packagePrice)
        
        // Open contact form with pre-filled package info
        this.openPackageForm(packageName, packagePrice)
      })
    })
  },
  
  /**
   * Track button click
   * 
   * @param {string} buttonText - The button text
   * @param {string} buttonType - The button type
   */
  trackButtonClick(buttonText, buttonType) {
    this.sendToGHL('button_click', {
      text: buttonText,
      type: buttonType,
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    })
  },
  
  /**
   * Track package interest
   * 
   * @param {string} packageName - The package name
   * @param {string} packagePrice - The package price
   */
  trackPackageInterest(packageName, packagePrice) {
    this.sendToGHL('package_interest', {
      package: packageName,
      price: packagePrice,
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    })
    
    // Track in Google Analytics if available
    if (typeof gtag !== 'undefined') {
      gtag('event', 'package_interest', {
        event_category: 'engagement',
        event_label: packageName,
        value: parseInt(packagePrice) || 0
      })
    }
    
    // Track in Facebook Pixel if available
    if (typeof fbq !== 'undefined') {
      fbq('track', 'ViewContent', {
        content_name: packageName,
        content_type: 'product',
        value: parseInt(packagePrice) || 0,
        currency: 'USD'
      })
    }
  },
  
  /**
   * Open package form
   * 
   * @param {string} packageName - The package name
   * @param {string} packagePrice - The package price
   */
  openPackageForm(packageName, packagePrice) {
    // Find pricing form
    const pricingForm = document.querySelector('form[data-ghl-form="pricing"]')
    
    if (pricingForm) {
      // Pre-fill package info
      const packageInput = pricingForm.querySelector('[name="package"]')
      const priceInput = pricingForm.querySelector('[name="package_price"]')
      
      if (packageInput) packageInput.value = packageName
      if (priceInput) priceInput.value = packagePrice
      
      // Scroll to form
      pricingForm.scrollIntoView({ behavior: 'smooth', block: 'center' })
      
      // Focus first input
      const firstInput = pricingForm.querySelector('input:not([type="hidden"])')
      if (firstInput) setTimeout(() => firstInput.focus(), 500)
    } else {
      // Fallback to contact form
      const contactForm = document.querySelector('form[data-ghl-form]')
      
      if (contactForm) {
        // Create hidden inputs for package info
        let packageInput = contactForm.querySelector('[name="package"]')
        let priceInput = contactForm.querySelector('[name="package_price"]')
        
        if (!packageInput) {
          packageInput = document.createElement('input')
          packageInput.type = 'hidden'
          packageInput.name = 'package'
          contactForm.appendChild(packageInput)
        }
        
        if (!priceInput) {
          priceInput = document.createElement('input')
          priceInput.type = 'hidden'
          priceInput.name = 'package_price'
          contactForm.appendChild(priceInput)
        }
        
        packageInput.value = packageName
        priceInput.value = packagePrice
        
        // Scroll to form
        contactForm.scrollIntoView({ behavior: 'smooth', block: 'center' })
        
        // Focus first input
        const firstInput = contactForm.querySelector('input:not([type="hidden"])')
        if (firstInput) setTimeout(() => firstInput.focus(), 500)
      }
    }
  },
  
  /**
   * Track conversion
   * 
   * @param {string} formType - The form type
   */
  trackConversion(formType) {
    // Send to GHL
    this.sendToGHL('conversion', {
      type: formType,
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    })
    
    // Google Analytics tracking
    if (typeof gtag !== 'undefined') {
      gtag('event', 'conversion', {
        send_to: 'AW-CONVERSION_ID/CONVERSION_LABEL',
        event_category: 'form_submission',
        event_label: formType,
        value: 1
      })
    }
    
    // Facebook Pixel tracking
    if (typeof fbq !== 'undefined') {
      fbq('track', 'Lead', {
        content_name: 'Smart Website Quote',
        content_category: formType,
        value: 2000,
        currency: 'USD'
      })
    }
  },
  
  /**
   * Send data to GHL
   * 
   * @param {string} event - The event name
   * @param {Object} data - The event data
   */
  sendToGHL(event, data) {
    // Skip if no GHL config
    if (!window.ghlConfig) return
    
    // Log event in development
    if (process.env.NODE_ENV === 'development') {
      console.log('GHL Event:', event, data)
      return
    }
    
    // Send to GHL API
    fetch('https://api.leadconnectorhq.com/events', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer YOUR_API_TOKEN'
      },
      body: JSON.stringify({
        locationId: window.ghlConfig.locationId,
        event: event,
        data: data,
        timestamp: new Date().toISOString()
      })
    }).catch(error => {
      console.error('Error sending event to GHL:', error)
    })
  }
}