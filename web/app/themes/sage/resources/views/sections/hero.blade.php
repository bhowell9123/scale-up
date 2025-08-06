<section class="hero section bg-gradient-to-br from-blue-50 to-purple-50 pt-24">
  <div class="container">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      {{-- Content Column --}}
      <div class="hero-content">
        <h1 class="hero-title text-4xl lg:text-6xl font-bold mb-6">
          Get More Customers with a
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-secondary-500">
            Smart Website
          </span>
        </h1>
        
        <p class="hero-subtitle text-xl text-gray-600 mb-8 leading-relaxed">
          Transform your local business with a professional website that ranks on Google,
          captures leads automatically, and converts visitors into paying customers.
        </p>
        
        {{-- Stats Row --}}
        <div class="hero-stats grid grid-cols-3 gap-6 mb-8">
          <div class="stat text-center">
            <div class="stat-number text-3xl font-bold text-primary-600">3x</div>
            <div class="stat-label text-sm text-gray-600">More Leads</div>
          </div>
          <div class="stat text-center">
            <div class="stat-number text-3xl font-bold text-primary-600">24/7</div>
            <div class="stat-label text-sm text-gray-600">Lead Generation</div>
          </div>
          <div class="stat text-center">
            <div class="stat-number text-3xl font-bold text-primary-600">Top</div>
            <div class="stat-label text-sm text-gray-600">Google Rankings</div>
          </div>
        </div>
        
        {{-- CTA Buttons --}}
        <div class="hero-actions flex flex-col sm:flex-row gap-4">
          <a href="#contact" class="btn btn-primary text-lg px-8 py-4">
            Get Your Free Quote
          </a>
          <a href="tel:+15551234567" class="btn btn-secondary text-lg px-8 py-4">
            Call (555) 123-4567
          </a>
        </div>
      </div>
      
      {{-- Image Column --}}
      <div class="hero-visual">
        <div class="hero-image-container relative">
          <img src="{{ get_stylesheet_directory_uri() . '/public/images/smart-website-dashboard.png' }}"
               alt="Smart Website Dashboard"
               class="w-full h-auto rounded-lg shadow-2xl">
          
          {{-- Floating Elements --}}
          <div class="floating-element absolute top-4 right-4 bg-white rounded-lg p-3 shadow-lg">
            <div class="flex items-center space-x-2">
              <div class="w-3 h-3 bg-green-500 rounded-full"></div>
              <span class="text-sm font-medium">SEO Ranking</span>
            </div>
          </div>
          
          <div class="floating-element absolute bottom-4 left-4 bg-white rounded-lg p-3 shadow-lg">
            <div class="flex items-center space-x-2">
              <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
              <span class="text-sm font-medium">Lead Generation</span>
            </div>
          </div>
          
          <div class="floating-element absolute top-1/2 -right-4 bg-white rounded-lg p-3 shadow-lg">
            <div class="flex items-center space-x-2">
              <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
              <span class="text-sm font-medium">AI Automation</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>