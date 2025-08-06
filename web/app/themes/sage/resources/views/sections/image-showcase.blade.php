<section id="showcase" class="image-showcase section bg-white py-16 lg:py-24">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="section-title text-3xl lg:text-5xl font-bold mb-6">
        Websites That Drive Business Growth
      </h2>
      <p class="section-subtitle text-xl text-gray-600 max-w-3xl mx-auto">
        Take a look at some of our Smart Websites in action. Each one is designed to 
        attract visitors, capture leads, and convert them into customers.
      </p>
    </div>
    
    <div class="showcase-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      {{-- Showcase Item 1 --}}
      <div class="showcase-item group relative overflow-hidden rounded-lg shadow-lg">
        <img 
          src="{{ asset('images/local-business-website.png') }}" 
          alt="Local Business Website Example" 
          class="w-full h-auto transition-transform duration-500 group-hover:scale-105"
        >
        <div class="showcase-overlay absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
          <h3 class="text-white text-xl font-bold mb-2">Local Business Website</h3>
          <p class="text-white/90 mb-4">Complete online presence for local service businesses with lead capture and booking.</p>
          <a href="#" class="inline-flex items-center text-white font-medium">
            <span>View Details</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>
      
      {{-- Showcase Item 2 --}}
      <div class="showcase-item group relative overflow-hidden rounded-lg shadow-lg">
        <img 
          src="{{ asset('images/smart-website-dashboard.png') }}" 
          alt="Smart Website Dashboard" 
          class="w-full h-auto transition-transform duration-500 group-hover:scale-105"
        >
        <div class="showcase-overlay absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
          <h3 class="text-white text-xl font-bold mb-2">Smart Website Dashboard</h3>
          <p class="text-white/90 mb-4">Real-time analytics and lead tracking dashboard for business owners.</p>
          <a href="#" class="inline-flex items-center text-white font-medium">
            <span>View Details</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>
      
      {{-- Showcase Item 3 --}}
      <div class="showcase-item group relative overflow-hidden rounded-lg shadow-lg">
        <img 
          src="{{ asset('images/seo-ranking-visual.png') }}" 
          alt="SEO Ranking Visual" 
          class="w-full h-auto transition-transform duration-500 group-hover:scale-105"
        >
        <div class="showcase-overlay absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
          <h3 class="text-white text-xl font-bold mb-2">SEO Performance</h3>
          <p class="text-white/90 mb-4">Built-in SEO optimization that helps businesses rank higher on Google.</p>
          <a href="#" class="inline-flex items-center text-white font-medium">
            <span>View Details</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    
    <div class="text-center mt-12">
      <a href="#contact" class="btn btn-primary">
        Get Your Smart Website
      </a>
    </div>
  </div>
</section>