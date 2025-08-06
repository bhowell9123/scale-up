<section id="contact" class="cta section bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="cta-content">
        <h2 class="section-title text-3xl lg:text-5xl font-bold mb-6">
          {{ get_field('cta_title') ?: 'Ready to Grow Your Business?' }}
        </h2>
        
        <p class="section-subtitle text-xl mb-8">
          {{ get_field('cta_subtitle') ?: 'Get started with a Smart Website today and see the difference it makes for your local business.' }}
        </p>
        
        <ul class="cta-benefits space-y-4 mb-8">
          @if(have_rows('cta_benefits'))
            @while(have_rows('cta_benefits')) @php(the_row())
              <li class="flex items-start">
                <svg class="w-6 h-6 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ get_sub_field('text') }}</span>
              </li>
            @endwhile
          @else
            <li class="flex items-start">
              <svg class="w-6 h-6 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>No long-term contracts - cancel anytime</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Free migration from your existing website</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Dedicated support team to help you succeed</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>100% satisfaction guarantee</span>
            </li>
          @endif
        </ul>
        
        <div class="cta-buttons flex flex-wrap gap-4">
          <a href="{{ get_field('cta_primary_button_url') ?: '#' }}" class="btn bg-white text-primary-600 hover:bg-gray-100">
            {{ get_field('cta_primary_button_text') ?: 'Get Started' }}
          </a>
          
          <a href="{{ get_field('cta_secondary_button_url') ?: '#' }}" class="btn border-2 border-white text-white hover:bg-white hover:text-primary-600">
            {{ get_field('cta_secondary_button_text') ?: 'Schedule a Demo' }}
          </a>
        </div>
      </div>
      
      <div class="cta-form bg-white rounded-lg shadow-xl p-8 text-gray-900">
        @if(get_field('form_shortcode'))
          {!! do_shortcode(get_field('form_shortcode')) !!}
        @else
          <x-contact-form
            formType="quote-request"
            title="{{ get_field('form_title') ?: 'Get Your Free Quote' }}"
            subtitle="{{ get_field('form_subtitle') ?: 'Fill out the form below and we\'ll get back to you within 24 hours.' }}"
            submitText="Get Your Free Quote"
            :showBusinessFields="true"
            :showMessageField="true"
            className="cta-contact-form"
          />
        @endif
      </div>
    </div>
  </div>
</section>