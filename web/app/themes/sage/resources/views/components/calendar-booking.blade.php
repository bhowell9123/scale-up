@props([
    'calendarId' => '7DUwt2e161ox8kn5pDDU',
    'title' => 'Book Your Free Consultation',
    'subtitle' => 'Choose a time that works for you. We\'ll discuss your website needs and provide a custom quote.',
    'height' => '600',
    'className' => '',
])

<div class="calendar-container {{ $className }}">
    <div class="calendar-header text-center mb-8">
        @if($title)
            <h3 class="text-2xl font-bold mb-4">{{ $title }}</h3>
        @endif
        
        @if($subtitle)
            <p class="text-gray-600">{{ $subtitle }}</p>
        @endif
    </div>
    
    <div class="calendar-embed">
        <iframe src="https://api.leadconnectorhq.com/widget/booking/{{ $calendarId }}" 
                width="100%" 
                height="{{ $height }}" 
                frameborder="0"
                class="rounded-lg shadow-lg">
        </iframe>
    </div>
</div>