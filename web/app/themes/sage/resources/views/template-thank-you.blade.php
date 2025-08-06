{{--
  Template Name: Thank You Page
--}}

@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-16 lg:py-24">
    <div class="max-w-3xl mx-auto text-center">
      <div class="mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-500 rounded-full mb-6">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        
        <h1 class="text-4xl lg:text-5xl font-bold mb-6">
          {{ get_field('thank_you_title') ?: 'Thank You!' }}
        </h1>
        
        <div class="prose max-w-2xl mx-auto mb-12">
          {!! get_field('thank_you_message') ?: '<p class="text-xl">Your submission has been received. We\'ll be in touch with you shortly.</p>' !!}
        </div>
      </div>
      
      <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
        <h3 class="text-2xl font-bold mb-6">{{ get_field('next_steps_title') ?: 'What Happens Next?' }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
          <div>
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-primary-100 text-primary-500 rounded-full flex items-center justify-center mr-4">
                <span class="font-bold">1</span>
              </div>
              <h4 class="font-semibold">{{ get_field('step_1_title') ?: 'Initial Contact' }}</h4>
            </div>
            <p class="text-gray-600 text-sm">{{ get_field('step_1_description') ?: 'Our team will reach out to you within 24 hours to confirm your request.' }}</p>
          </div>
          
          <div>
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-primary-100 text-primary-500 rounded-full flex items-center justify-center mr-4">
                <span class="font-bold">2</span>
              </div>
              <h4 class="font-semibold">{{ get_field('step_2_title') ?: 'Consultation Call' }}</h4>
            </div>
            <p class="text-gray-600 text-sm">{{ get_field('step_2_description') ?: 'We\'ll schedule a call to discuss your business needs and website goals.' }}</p>
          </div>
          
          <div>
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-primary-100 text-primary-500 rounded-full flex items-center justify-center mr-4">
                <span class="font-bold">3</span>
              </div>
              <h4 class="font-semibold">{{ get_field('step_3_title') ?: 'Custom Proposal' }}</h4>
            </div>
            <p class="text-gray-600 text-sm">{{ get_field('step_3_description') ?: 'You\'ll receive a tailored proposal based on your specific requirements.' }}</p>
          </div>
        </div>
      </div>
      
      @if(get_field('show_resources_section'))
        <div class="mb-12">
          <h3 class="text-2xl font-bold mb-6">{{ get_field('resources_title') ?: 'Resources You Might Find Helpful' }}</h3>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if(have_rows('resources'))
              @while(have_rows('resources')) @php(the_row())
                <a href="{{ get_sub_field('url') }}" class="bg-white rounded-lg shadow-md p-6 flex items-start hover:shadow-lg transition-shadow">
                  <div class="text-primary-500 mr-4 flex-shrink-0">
                    {!! get_sub_field('icon') ?: '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>' !!}
                  </div>
                  <div>
                    <h4 class="font-semibold mb-1">{{ get_sub_field('title') }}</h4>
                    <p class="text-gray-600 text-sm">{{ get_sub_field('description') }}</p>
                  </div>
                </a>
              @endwhile
            @else
              <a href="/case-studies" class="bg-white rounded-lg shadow-md p-6 flex items-start hover:shadow-lg transition-shadow">
                <div class="text-primary-500 mr-4 flex-shrink-0">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold mb-1">Case Studies</h4>
                  <p class="text-gray-600 text-sm">See how other businesses have succeeded with our Smart Websites.</p>
                </div>
              </a>
              
              <a href="/blog" class="bg-white rounded-lg shadow-md p-6 flex items-start hover:shadow-lg transition-shadow">
                <div class="text-primary-500 mr-4 flex-shrink-0">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold mb-1">Marketing Blog</h4>
                  <p class="text-gray-600 text-sm">Tips and strategies to help grow your local business online.</p>
                </div>
              </a>
            @endif
          </div>
        </div>
      @endif
      
      <div>
        <a href="{{ get_field('return_button_url') ?: home_url('/') }}" class="btn btn-primary">
          {{ get_field('return_button_text') ?: 'Return to Homepage' }}
        </a>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{-- GoHighLevel Conversion Tracking --}}
  <script>
    (function() {
      // Track conversion in GHL
      if (window.ghlTracking && typeof window.ghlTracking.sendToGHL === 'function') {
        window.ghlTracking.sendToGHL('conversion', {
          type: '{{ get_field('conversion_type') ?: 'form_submission' }}',
          page: window.location.pathname,
          timestamp: new Date().toISOString()
        });
      }
      
      // Google Analytics conversion tracking
      if (typeof gtag !== 'undefined') {
        gtag('event', 'conversion', {
          'send_to': 'AW-7DUwt2e161ox8kn5pDDU/CONVERSION_LABEL',
          'event_category': 'form_submission',
          'event_label': '{{ get_field('conversion_type') ?: 'form_submission' }}',
          'value': 1
        });
      }
      
      // Facebook Pixel conversion tracking
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Lead', {
          content_name: 'Smart Website Quote',
          content_category: '{{ get_field('conversion_type') ?: 'form_submission' }}',
          value: 2000,
          currency: 'USD'
        });
      }
    })();
  </script>
@endpush