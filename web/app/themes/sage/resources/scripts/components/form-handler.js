/**
 * Form Handler Component
 * 
 * Handles form submissions and validation
 */
export const formHandler = {
  init() {
    this.initForms()
    this.initValidation()
  },
  
  /**
   * Initialize form handling
   */
  initForms() {
    const forms = document.querySelectorAll('form')
    
    forms.forEach(form => {
      // Skip forms that should not be handled by this component
      if (form.classList.contains('no-ajax') || form.getAttribute('data-no-ajax') === 'true') {
        return
      }
      
      // Check if form is a GoHighLevel form
      const isGhlForm = form.hasAttribute('data-ghl-form')
      
      form.addEventListener('submit', (e) => {
        // Prevent default form submission
        e.preventDefault()
        
        // Validate form
        if (!this.validateForm(form)) {
          return
        }
        
        // Handle form submission
        if (isGhlForm) {
          this.submitGhlForm(form)
        } else {
          this.submitForm(form)
        }
      })
    })
  },
  
  /**
   * Initialize form validation
   */
  initValidation() {
    const inputs = document.querySelectorAll('input, textarea, select')
    
    inputs.forEach(input => {
      // Skip inputs that should not be validated
      if (input.classList.contains('no-validate') || input.getAttribute('data-no-validate') === 'true') {
        return
      }
      
      // Validate on blur
      input.addEventListener('blur', () => {
        this.validateInput(input)
      })
      
      // Clear error on focus
      input.addEventListener('focus', () => {
        this.clearInputError(input)
      })
    })
  },
  
  /**
   * Validate form
   * 
   * @param {HTMLFormElement} form - The form to validate
   * @returns {boolean} - Whether the form is valid
   */
  validateForm(form) {
    let isValid = true
    const inputs = form.querySelectorAll('input, textarea, select')
    
    inputs.forEach(input => {
      // Skip inputs that should not be validated
      if (input.classList.contains('no-validate') || input.getAttribute('data-no-validate') === 'true') {
        return
      }
      
      if (!this.validateInput(input)) {
        isValid = false
      }
    })
    
    return isValid
  },
  
  /**
   * Validate input
   * 
   * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} input - The input to validate
   * @returns {boolean} - Whether the input is valid
   */
  validateInput(input) {
    // Skip disabled or hidden inputs
    if (input.disabled || input.type === 'hidden') {
      return true
    }
    
    // Get validation type
    const validationType = input.getAttribute('data-validate') || input.type
    
    // Check if required
    const isRequired = input.required || input.getAttribute('data-required') === 'true'
    
    // Get input value
    const value = input.value.trim()
    
    // Check if empty
    if (isRequired && !value) {
      this.setInputError(input, 'This field is required')
      return false
    }
    
    // Skip further validation if empty and not required
    if (!value) {
      return true
    }
    
    // Validate based on type
    switch (validationType) {
      case 'email':
        if (!this.isValidEmail(value)) {
          this.setInputError(input, 'Please enter a valid email address')
          return false
        }
        break
        
      case 'tel':
      case 'phone':
        if (!this.isValidPhone(value)) {
          this.setInputError(input, 'Please enter a valid phone number')
          return false
        }
        break
        
      case 'url':
        if (!this.isValidUrl(value)) {
          this.setInputError(input, 'Please enter a valid URL')
          return false
        }
        break
        
      case 'number':
        if (!this.isValidNumber(value)) {
          this.setInputError(input, 'Please enter a valid number')
          return false
        }
        break
        
      case 'zip':
      case 'zipcode':
        if (!this.isValidZipCode(value)) {
          this.setInputError(input, 'Please enter a valid ZIP code')
          return false
        }
        break
    }
    
    // Check min/max length
    const minLength = parseInt(input.getAttribute('minlength') || input.getAttribute('data-minlength') || 0)
    const maxLength = parseInt(input.getAttribute('maxlength') || input.getAttribute('data-maxlength') || 0)
    
    if (minLength && value.length < minLength) {
      this.setInputError(input, `Please enter at least ${minLength} characters`)
      return false
    }
    
    if (maxLength && value.length > maxLength) {
      this.setInputError(input, `Please enter no more than ${maxLength} characters`)
      return false
    }
    
    // Check pattern
    const pattern = input.getAttribute('pattern') || input.getAttribute('data-pattern')
    
    if (pattern && !new RegExp(pattern).test(value)) {
      this.setInputError(input, input.getAttribute('data-pattern-message') || 'Please enter a valid value')
      return false
    }
    
    // Input is valid
    this.clearInputError(input)
    return true
  },
  
  /**
   * Set input error
   * 
   * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} input - The input to set error on
   * @param {string} message - The error message
   */
  setInputError(input, message) {
    // Add error class
    input.classList.add('error')
    
    // Get or create error element
    let errorElement = input.parentNode.querySelector('.form-error')
    
    if (!errorElement) {
      errorElement = document.createElement('div')
      errorElement.className = 'form-error'
      input.parentNode.appendChild(errorElement)
    }
    
    // Set error message
    errorElement.textContent = message
    errorElement.style.display = 'block'
  },
  
  /**
   * Clear input error
   * 
   * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} input - The input to clear error from
   */
  clearInputError(input) {
    // Remove error class
    input.classList.remove('error')
    
    // Hide error element
    const errorElement = input.parentNode.querySelector('.form-error')
    
    if (errorElement) {
      errorElement.style.display = 'none'
    }
  },
  
  /**
   * Submit form
   * 
   * @param {HTMLFormElement} form - The form to submit
   */
  submitForm(form) {
    // Show loading state
    this.setFormLoading(form, true)
    
    // Get form data
    const formData = new FormData(form)
    
    // Get form action
    const action = form.getAttribute('action') || window.location.href
    
    // Get form method
    const method = form.getAttribute('method') || 'POST'
    
    // Submit form
    fetch(action, {
      method: method.toUpperCase(),
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      },
    })
      .then(response => response.json())
      .then(data => {
        // Hide loading state
        this.setFormLoading(form, false)
        
        // Handle success
        if (data.success) {
          this.handleFormSuccess(form, data)
        } else {
          this.handleFormError(form, data)
        }
      })
      .catch(error => {
        // Hide loading state
        this.setFormLoading(form, false)
        
        // Handle error
        this.handleFormError(form, { message: 'An error occurred. Please try again.' })
        console.error('Form submission error:', error)
      })
  },
  
  /**
   * Submit GoHighLevel form
   * 
   * @param {HTMLFormElement} form - The form to submit
   */
  submitGhlForm(form) {
    // Show loading state
    this.setFormLoading(form, true)
    
    // Get form data
    const formData = new FormData(form)
    const formObject = {}
    
    formData.forEach((value, key) => {
      formObject[key] = value
    })
    
    // Get form type
    const formType = form.getAttribute('data-ghl-form')
    
    // Get endpoint from environment or data attribute
    const endpoint = form.getAttribute('data-ghl-endpoint') || window.GHL_FORM_ENDPOINT || ''
    
    if (!endpoint) {
      console.error('No GoHighLevel endpoint found')
      this.handleFormError(form, { message: 'Configuration error. Please contact the administrator.' })
      this.setFormLoading(form, false)
      return
    }
    
    // Add form type to data
    formObject.formType = formType
    
    // Add page information
    formObject.pageUrl = window.location.href
    formObject.pageName = document.title
    
    // Submit form to GoHighLevel
    fetch(endpoint, {
      method: 'POST',
      body: JSON.stringify(formObject),
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
    })
      .then(response => response.json())
      .then(data => {
        // Hide loading state
        this.setFormLoading(form, false)
        
        // Handle success
        if (data.success) {
          this.handleFormSuccess(form, data)
        } else {
          this.handleFormError(form, data)
        }
      })
      .catch(error => {
        // Hide loading state
        this.setFormLoading(form, false)
        
        // Handle error
        this.handleFormError(form, { message: 'An error occurred. Please try again.' })
        console.error('GHL form submission error:', error)
      })
  },
  
  /**
   * Set form loading state
   * 
   * @param {HTMLFormElement} form - The form to set loading state on
   * @param {boolean} isLoading - Whether the form is loading
   */
  setFormLoading(form, isLoading) {
    // Add/remove loading class
    if (isLoading) {
      form.classList.add('form-submitting')
    } else {
      form.classList.remove('form-submitting')
    }
    
    // Disable/enable inputs
    const inputs = form.querySelectorAll('input, textarea, select, button')
    
    inputs.forEach(input => {
      input.disabled = isLoading
    })
    
    // Update submit button
    const submitButton = form.querySelector('[type="submit"]')
    
    if (submitButton) {
      if (isLoading) {
        submitButton.classList.add('submitting')
        submitButton.dataset.originalText = submitButton.innerHTML
        submitButton.innerHTML = 'Submitting...'
      } else if (submitButton.dataset.originalText) {
        submitButton.classList.remove('submitting')
        submitButton.innerHTML = submitButton.dataset.originalText
        delete submitButton.dataset.originalText
      }
    }
  },
  
  /**
   * Handle form success
   * 
   * @param {HTMLFormElement} form - The form that was submitted
   * @param {Object} data - The response data
   */
  handleFormSuccess(form, data) {
    // Show success message
    const successMessage = data.message || 'Form submitted successfully!'
    
    // Check if form has a success message container
    const messageContainer = form.querySelector('.form-feedback') || document.createElement('div')
    
    if (!form.contains(messageContainer)) {
      messageContainer.className = 'form-feedback success'
      form.appendChild(messageContainer)
    } else {
      messageContainer.className = 'form-feedback success'
    }
    
    messageContainer.innerHTML = successMessage
    messageContainer.style.display = 'block'
    
    // Reset form
    form.reset()
    
    // Check for redirect
    if (data.redirect) {
      setTimeout(() => {
        window.location.href = data.redirect
      }, 1000)
    }
    
    // Check for callback
    const callback = form.getAttribute('data-success-callback')
    
    if (callback && typeof window[callback] === 'function') {
      window[callback](form, data)
    }
  },
  
  /**
   * Handle form error
   * 
   * @param {HTMLFormElement} form - The form that was submitted
   * @param {Object} data - The response data
   */
  handleFormError(form, data) {
    // Show error message
    const errorMessage = data.message || 'An error occurred. Please try again.'
    
    // Check if form has an error message container
    const messageContainer = form.querySelector('.form-feedback') || document.createElement('div')
    
    if (!form.contains(messageContainer)) {
      messageContainer.className = 'form-feedback error'
      form.appendChild(messageContainer)
    } else {
      messageContainer.className = 'form-feedback error'
    }
    
    messageContainer.innerHTML = errorMessage
    messageContainer.style.display = 'block'
    
    // Handle field errors
    if (data.errors) {
      Object.entries(data.errors).forEach(([field, message]) => {
        const input = form.querySelector(`[name="${field}"]`)
        
        if (input) {
          this.setInputError(input, message)
        }
      })
    }
    
    // Check for callback
    const callback = form.getAttribute('data-error-callback')
    
    if (callback && typeof window[callback] === 'function') {
      window[callback](form, data)
    }
  },
  
  /**
   * Check if email is valid
   * 
   * @param {string} email - The email to validate
   * @returns {boolean} - Whether the email is valid
   */
  isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return regex.test(email)
  },
  
  /**
   * Check if phone number is valid
   * 
   * @param {string} phone - The phone number to validate
   * @returns {boolean} - Whether the phone number is valid
   */
  isValidPhone(phone) {
    // Remove non-numeric characters
    const numericPhone = phone.replace(/\D/g, '')
    
    // Check if phone has at least 10 digits
    return numericPhone.length >= 10
  },
  
  /**
   * Check if URL is valid
   * 
   * @param {string} url - The URL to validate
   * @returns {boolean} - Whether the URL is valid
   */
  isValidUrl(url) {
    try {
      new URL(url)
      return true
    } catch (e) {
      return false
    }
  },
  
  /**
   * Check if number is valid
   * 
   * @param {string} number - The number to validate
   * @returns {boolean} - Whether the number is valid
   */
  isValidNumber(number) {
    return !isNaN(parseFloat(number)) && isFinite(number)
  },
  
  /**
   * Check if ZIP code is valid
   * 
   * @param {string} zipCode - The ZIP code to validate
   * @returns {boolean} - Whether the ZIP code is valid
   */
  isValidZipCode(zipCode) {
    // US ZIP code (5 digits or 5+4)
    const usZipRegex = /^\d{5}(?:-\d{4})?$/
    
    // Canadian postal code
    const caPostalRegex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/
    
    return usZipRegex.test(zipCode) || caPostalRegex.test(zipCode)
  }
}