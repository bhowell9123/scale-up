@props([
    'formType' => 'quote-request',
    'title' => 'Get Your Free Quote',
    'subtitle' => 'Fill out the form below and we\'ll get back to you within 24 hours.',
    'submitText' => 'Get Your Free Quote',
    'showBusinessFields' => true,
    'showMessageField' => true,
    'className' => '',
])

<div class="contact-form-container {{ $className }}">
    @if($title || $subtitle)
        <div class="form-header mb-8">
            @if($title)
                <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
            @endif
            
            @if($subtitle)
                <p class="text-gray-600">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    <form id="ghl-contact-form" class="contact-form space-y-6" data-ghl-form="{{ $formType }}">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="first_name" class="form-label">First Name *</label>
                <input type="text" id="first_name" name="first_name" required 
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            
            <div class="form-group">
                <label for="last_name" class="form-label">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required 
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" id="email" name="email" required 
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            
            <div class="form-group">
                <label for="phone" class="form-label">Phone Number *</label>
                <input type="tel" id="phone" name="phone" required 
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>
        
        @if($showBusinessFields)
            <div class="form-group">
                <label for="business_name" class="form-label">Business Name</label>
                <input type="text" id="business_name" name="business_name" 
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            
            <div class="form-group">
                <label for="current_website" class="form-label">Current Website (if any)</label>
                <input type="url" id="current_website" name="current_website" 
                       placeholder="https://yourwebsite.com"
                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        @endif
        
        @if($showMessageField)
            <div class="form-group">
                <label for="message" class="form-label">Tell us about your business and website needs</label>
                <textarea id="message" name="message" rows="4" 
                          class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"></textarea>
            </div>
        @endif
        
        {{-- Hidden fields for package selection --}}
        <input type="hidden" name="package" value="">
        <input type="hidden" name="package_price" value="">
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-full text-lg py-4">
                <span class="btn-text">{{ $submitText }}</span>
                <span class="btn-loading hidden">
                    <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Submitting...
                </span>
            </button>
        </div>
        
        <div class="form-message hidden p-4 rounded-lg"></div>
        
        <div class="text-sm text-gray-500 text-center">
            By submitting this form, you agree to our 
            <a href="/privacy-policy" class="text-primary-500 hover:underline">Privacy Policy</a> and 
            <a href="/terms-of-service" class="text-primary-500 hover:underline">Terms of Service</a>.
        </div>
    </form>
</div>