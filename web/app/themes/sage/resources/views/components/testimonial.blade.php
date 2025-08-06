@props([
    'quote' => '',
    'author' => '',
    'company' => '',
    'position' => '',
    'rating' => 5,
    'image' => null,
    'className' => '',
])

<div class="testimonial {{ $className }}">
    <div class="bg-white rounded-lg shadow-lg p-6 h-full">
        @if($rating)
            <div class="flex mb-4">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
            </div>
        @endif
        
        <blockquote class="text-gray-700 italic mb-6">
            "{{ $quote }}"
        </blockquote>
        
        <div class="flex items-center">
            @if($image)
                <div class="mr-4">
                    <img src="{{ $image }}" alt="{{ $author }}" class="w-12 h-12 rounded-full object-cover">
                </div>
            @endif
            
            <div>
                <div class="font-semibold">{{ $author }}</div>
                @if($position || $company)
                    <div class="text-sm text-gray-500">
                        @if($position)
                            {{ $position }}
                            @if($company)
                                , {{ $company }}
                            @endif
                        @else
                            {{ $company }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>