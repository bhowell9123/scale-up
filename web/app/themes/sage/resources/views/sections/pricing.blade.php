<section id="pricing" class="pricing section bg-gray-50">
  <div class="container">
    <div class="text-center mb-16">
      <h2 class="section-title text-3xl lg:text-5xl font-bold mb-6">
        {{ get_field('pricing_title') ?: 'Choose Your Smart Website Package' }}
      </h2>
      
      <p class="section-subtitle text-xl text-gray-600 max-w-3xl mx-auto">
        {{ get_field('pricing_subtitle') ?: 'Select the package that best fits your business needs and budget.' }}
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
      @if(have_rows('pricing_packages'))
        @while(have_rows('pricing_packages')) @php(the_row())
          <x-pricing-card
            name="{{ get_sub_field('name') }}"
            price="{{ get_sub_field('price') }}"
            period="{{ get_sub_field('period') }}"
            description="{{ get_sub_field('description') }}"
            :features="get_sub_field('features')"
            buttonText="{{ get_sub_field('button_text') }}"
            buttonUrl="{{ get_sub_field('button_url') }}"
            :highlighted="get_sub_field('highlighted')"
          />
        @endwhile
      @else
        {{-- Default pricing cards if no ACF data --}}
        <x-pricing-card
          name="Starter"
          price="1997"
          period="/one-time"
          description="Perfect for small businesses just getting started."
          :features="[
            'Custom Website Design',
            'Mobile Responsive',
            'Lead Capture Forms',
            'Basic SEO Setup',
            'Google Business Integration',
            '1 Month Support'
          ]"
          buttonText="Get Started"
        />
        
        <x-pricing-card
          name="Growth"
          price="2997"
          period="/one-time"
          description="Ideal for businesses looking to expand their online presence."
          :features="[
            'Everything in Starter',
            'Advanced SEO Package',
            'Email Marketing Setup',
            'Review Management',
            'Social Media Integration',
            'Appointment Booking',
            '3 Months Support'
          ]"
          buttonText="Most Popular"
          :highlighted="true"
        />
        
        <x-pricing-card
          name="Premium"
          price="4997"
          period="/one-time"
          description="Complete solution for established businesses."
          :features="[
            'Everything in Growth',
            'Custom Integrations',
            'Advanced Analytics',
            'Conversion Optimization',
            'Marketing Automation',
            'Priority Support',
            '6 Months Support'
          ]"
          buttonText="Get Started"
        />
      @endif
    </div>
    
    <div class="pricing-guarantee bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto mb-16">
      <div class="flex flex-col md:flex-row items-center gap-6">
        <div class="guarantee-icon text-primary-500 flex-shrink-0">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
          </svg>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-2">100% Satisfaction Guarantee</h3>
          <p class="text-gray-600">
            We're so confident in our Smart Websites that we offer a 30-day satisfaction guarantee.
            If you're not completely satisfied with your website, we'll make it right or refund your money.
          </p>
        </div>
      </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto">
      <div class="text-center mb-8">
        <h3 class="text-2xl font-bold mb-2">
          {{ get_field('custom_package_title') ?: 'Need a Custom Solution?' }}
        </h3>
        <p class="text-gray-600">
          {{ get_field('custom_package_description') ?: 'Contact us for a tailored package that meets your specific business requirements.' }}
        </p>
      </div>
      
      <x-contact-form
        formType="custom-quote"
        title=""
        subtitle=""
        submitText="Request Custom Quote"
        :showBusinessFields="true"
        :showMessageField="true"
        className="custom-quote-form"
      />
    </div>
  </div>
</section>