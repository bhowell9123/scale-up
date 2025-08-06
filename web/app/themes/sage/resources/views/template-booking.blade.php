{{--
  Template Name: Booking Page
--}}

@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-16 lg:py-24">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-12">
        <h1 class="text-4xl lg:text-5xl font-bold mb-6">
          {{ get_field('booking_title') ?: get_the_title() ?: 'Book Your Consultation' }}
        </h1>
        
        <div class="prose max-w-3xl mx-auto">
          {{ get_field('booking_description') ?: get_the_content() ?: 'Choose a time that works for you. We\'ll discuss your website needs and provide a custom quote.' }}
        </div>
      </div>
      
      <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <x-calendar-booking
          calendarId="{{ get_field('calendar_id') ?: '7DUwt2e161ox8kn5pDDU' }}"
          title=""
          subtitle=""
          height="700"
        />
      </div>
      
      <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-primary-500 mb-4">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">{{ get_field('benefit_1_title') ?: '30-Minute Consultation' }}</h3>
            <p class="text-gray-600">{{ get_field('benefit_1_description') ?: 'A focused session to discuss your business needs and website goals.' }}</p>
          </div>
          
          <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-primary-500 mb-4">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">{{ get_field('benefit_2_title') ?: 'Custom Quote' }}</h3>
            <p class="text-gray-600">{{ get_field('benefit_2_description') ?: 'Receive a tailored proposal based on your specific business requirements.' }}</p>
          </div>
          
          <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-primary-500 mb-4">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">{{ get_field('benefit_3_title') ?: 'No Obligation' }}</h3>
            <p class="text-gray-600">{{ get_field('benefit_3_description') ?: 'Learn about our services with no pressure or commitment required.' }}</p>
          </div>
        </div>
      </div>
      
      <div class="mt-16 text-center">
        <h3 class="text-2xl font-bold mb-4">{{ get_field('faq_title') ?: 'Frequently Asked Questions' }}</h3>
        
        <div class="mt-8 text-left">
          <div class="space-y-6">
            @if(have_rows('faqs'))
              @while(have_rows('faqs')) @php(the_row())
                <div class="bg-white rounded-lg shadow-md p-6">
                  <h4 class="text-lg font-semibold mb-2">{{ get_sub_field('question') }}</h4>
                  <p class="text-gray-600">{{ get_sub_field('answer') }}</p>
                </div>
              @endwhile
            @else
              <div class="bg-white rounded-lg shadow-md p-6">
                <h4 class="text-lg font-semibold mb-2">What happens during the consultation?</h4>
                <p class="text-gray-600">During our 30-minute call, we'll discuss your business goals, current website challenges, and how our Smart Website solution can help you generate more leads and sales.</p>
              </div>
              
              <div class="bg-white rounded-lg shadow-md p-6">
                <h4 class="text-lg font-semibold mb-2">How soon can you build my website?</h4>
                <p class="text-gray-600">Most Smart Websites can be completed within 2-3 weeks from the start date, depending on the complexity and your feedback timeline.</p>
              </div>
              
              <div class="bg-white rounded-lg shadow-md p-6">
                <h4 class="text-lg font-semibold mb-2">Do I need to prepare anything for the call?</h4>
                <p class="text-gray-600">It's helpful to have your current website URL handy and a list of any specific features or functionality you're looking for in your new website.</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection