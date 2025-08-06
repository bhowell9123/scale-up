@props([
    'videoId' => '',
    'thumbnail' => '',
    'title' => '',
    'aspectRatio' => '16/9',
])

<div 
    {{ $attributes->merge(['class' => 'relative rounded-xl overflow-hidden shadow-xl']) }}
    style="aspect-ratio: {{ $aspectRatio }};"
>
    <div class="video-player" data-video-id="{{ $videoId }}">
        <img 
            src="{{ $thumbnail }}" 
            alt="{{ $title }}" 
            class="w-full h-full object-cover"
        >
        
        <button class="play-button absolute inset-0 flex items-center justify-center">
            <div class="w-20 h-20 bg-primary-500 bg-opacity-80 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-opacity-100 hover:scale-110">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
        </button>
        
        @if($title)
            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white p-4">
                <h3 class="font-semibold">{{ $title }}</h3>
            </div>
        @endif
    </div>
</div>