<section id="testimonials" class="py-16 lg:py-24">
  <div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto text-center mb-16">
      <h2 class="text-3xl lg:text-5xl font-bold mb-6">
        {{ get_field('testimonials_title') ?: 'What Our Clients Say' }}
      </h2>
      
      <p class="text-xl text-gray-600">
        {{ get_field('testimonials_subtitle') ?: 'Hear from businesses that have transformed their online presence with our Smart Websites.' }}
      </p>
    </div>
    
    <div class="testimonials-slider">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
          // Get testimonials from custom post type
          $testimonials = new WP_Query([
            'post_type' => 'testimonial',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
          ]);
        @endphp
        
        @if($testimonials->have_posts())
          @while($testimonials->have_posts()) @php($testimonials->the_post())
            <x-testimonial
              quote="{{ get_the_content() }}"
              author="{{ get_field('client_name') ?: get_the_title() }}"
              company="{{ get_field('client_company') }}"
              position="{{ get_field('client_position') }}"
              rating="{{ get_field('testimonial_rating') }}"
              image="{{ get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') }}"
            />
          @endwhile
          @php(wp_reset_postdata())
        @else
          {{-- Default testimonials if no custom post type data --}}
          <x-testimonial
            quote="ScaleUp Marketing transformed our online presence. Our new website not only looks amazing but actually generates leads consistently. The ROI has been incredible!"
            author="John Smith"
            company="Local Plumbing Co."
            position="Owner"
            rating="5"
          />
          
          <x-testimonial
            quote="The Smart Website has completely changed how we do business. The automated follow-up system means we never miss a lead, and our conversion rate has doubled."
            author="Sarah Johnson"
            company="Johnson Real Estate"
            position="Broker"
            rating="5"
          />
          
          <x-testimonial
            quote="We were struggling to track our marketing ROI before working with ScaleUp. Now we know exactly where our leads are coming from and which marketing channels are working."
            author="Michael Brown"
            company="Brown's Auto Repair"
            position="Manager"
            rating="4"
          />
        @endif
      </div>
    </div>
    
    <div class="mt-12 text-center">
      <a href="{{ get_field('testimonials_button_url') ?: '/case-studies' }}" class="btn btn-secondary">
        {{ get_field('testimonials_button_text') ?: 'View All Success Stories' }}
      </a>
    </div>
    
    <div class="mt-16 pt-16 border-t border-gray-200">
      <div class="text-center mb-8">
        <h3 class="text-2xl font-bold">
          {{ get_field('brands_title') ?: 'Trusted by Local Businesses' }}
        </h3>
      </div>
      
      <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
        @if(have_rows('brand_logos'))
          @while(have_rows('brand_logos')) @php(the_row())
            <div class="brand-logo">
              <img 
                src="{{ get_sub_field('logo')['url'] }}" 
                alt="{{ get_sub_field('logo')['alt'] ?: get_sub_field('name') }}" 
                class="h-12 md:h-16 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
              >
            </div>
          @endwhile
        @else
          {{-- Default brand logos --}}
          <div class="brand-logo">
            <img src="{{ asset('images/brands/brand1.png') }}" alt="Brand 1" class="h-12 md:h-16 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          </div>
          <div class="brand-logo">
            <img src="{{ asset('images/brands/brand2.png') }}" alt="Brand 2" class="h-12 md:h-16 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          </div>
          <div class="brand-logo">
            <img src="{{ asset('images/brands/brand3.png') }}" alt="Brand 3" class="h-12 md:h-16 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          </div>
          <div class="brand-logo">
            <img src="{{ asset('images/brands/brand4.png') }}" alt="Brand 4" class="h-12 md:h-16 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          </div>
        @endif
      </div>
    </div>
  </div>
</section>