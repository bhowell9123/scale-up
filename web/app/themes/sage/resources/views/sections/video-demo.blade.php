<section id="video-demo" class="py-16 lg:py-24 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto text-center mb-16">
      <h2 class="text-3xl lg:text-5xl font-bold mb-6">
        {{ get_field('video_title') ?: 'See It In Action' }}
      </h2>
      
      <p class="text-xl text-gray-600">
        {{ get_field('video_subtitle') ?: 'Watch how our Smart Website platform helps local businesses generate more leads and sales.' }}
      </p>
    </div>
    
    <div class="max-w-4xl mx-auto">
      <div class="relative rounded-xl overflow-hidden shadow-2xl aspect-video">
        @if(get_field('video_embed'))
          {!! get_field('video_embed') !!}
        @else
          <div class="video-player" data-video-id="smart-website-demo">
            <img 
              src="{{ asset('images/video-thumbnail.jpg') }}" 
              alt="Video Thumbnail" 
              class="w-full h-full object-cover"
            >
            <button class="play-button absolute inset-0 flex items-center justify-center">
              <div class="w-20 h-20 bg-primary-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </button>
          </div>
        @endif
      </div>
      
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
          <div class="text-primary-500 mb-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="font-bold text-lg mb-2">Quick Setup</h3>
          <p class="text-gray-600">Your Smart Website can be up and running in as little as 48 hours.</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
          <div class="text-primary-500 mb-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="font-bold text-lg mb-2">Instant Results</h3>
          <p class="text-gray-600">Start capturing leads and automating your marketing from day one.</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
          <div class="text-primary-500 mb-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3 class="font-bold text-lg mb-2">Ongoing Support</h3>
          <p class="text-gray-600">Our team is always available to help you maximize your results.</p>
        </div>
      </div>
    </div>
  </div>
</section>