@props([
    'title' => '',
    'icon' => null,
    'iconColor' => 'primary',
    'link' => null,
])

@php
    $iconColorClasses = [
        'primary' => 'bg-primary-100 text-primary-500',
        'secondary' => 'bg-secondary-100 text-secondary-500',
        'success' => 'bg-green-100 text-green-500',
        'danger' => 'bg-red-100 text-red-500',
        'warning' => 'bg-yellow-100 text-yellow-500',
        'info' => 'bg-blue-100 text-blue-500',
    ][$iconColor] ?? 'bg-primary-100 text-primary-500';
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-lg p-8']) }}>
    @if($icon)
        <div class="w-12 h-12 {{ $iconColorClasses }} rounded-full flex items-center justify-center mb-6">
            {!! $icon !!}
        </div>
    @endif
    
    @if($title)
        <h3 class="text-xl font-bold mb-4">{{ $title }}</h3>
    @endif
    
    <div class="text-gray-600">
        {{ $slot }}
    </div>
    
    @if($link)
        <div class="mt-6">
            <a href="{{ $link['url'] }}" class="text-primary-500 hover:text-primary-600 font-medium inline-flex items-center">
                {{ $link['text'] }}
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif
</div>