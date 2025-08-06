@props([
    'href' => '#',
    'type' => 'primary',
    'size' => 'md',
    'target' => null,
    'rel' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold transition-all duration-200 rounded-lg';
    
    $sizeClasses = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ][$size] ?? 'px-6 py-3 text-base';
    
    $typeClasses = [
        'primary' => 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white hover:from-primary-600 hover:to-secondary-600',
        'secondary' => 'border-2 border-primary-500 text-primary-500 hover:bg-primary-500 hover:text-white',
        'white' => 'bg-white text-primary-600 hover:bg-gray-100',
        'outline-white' => 'border-2 border-white text-white hover:bg-white hover:text-primary-600',
        'text' => 'text-primary-500 hover:text-primary-600 underline',
    ][$type] ?? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white hover:from-primary-600 hover:to-secondary-600';
    
    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $typeClasses;
@endphp

<a 
    href="{{ $href }}"
    {{ $target ? "target={$target}" : '' }}
    {{ $rel ? "rel={$rel}" : '' }}
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</a>