@props([
    'name' => 'Basic Package',
    'price' => '1997',
    'period' => '/month',
    'description' => 'Perfect for small businesses just getting started.',
    'features' => [],
    'buttonText' => 'Get Started',
    'buttonUrl' => '#contact',
    'highlighted' => false,
    'className' => '',
])

<div class="pricing-card {{ $highlighted ? 'pricing-card-highlighted' : '' }} {{ $className }}">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 h-full {{ $highlighted ? 'border-2 border-primary-500 transform scale-105 shadow-xl' : '' }}">
        <div class="p-6 {{ $highlighted ? 'bg-primary-500 text-white' : '' }}">
            <h3 class="text-xl font-bold mb-2">{{ $name }}</h3>
            <div class="flex items-end mb-4">
                <span class="text-4xl font-bold">${{ $price }}</span>
                @if($period)
                    <span class="text-sm ml-1 pb-1 {{ $highlighted ? 'text-white' : 'text-gray-500' }}">{{ $period }}</span>
                @endif
            </div>
            <p class="text-sm {{ $highlighted ? 'text-white' : 'text-gray-600' }}">{{ $description }}</p>
        </div>
        
        <div class="p-6 border-t border-gray-100">
            <ul class="space-y-3 mb-6">
                @foreach($features as $feature)
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
            
            <button 
                class="w-full btn {{ $highlighted ? 'btn-primary' : 'btn-secondary' }}"
                data-package="{{ $name }}"
                data-price="{{ $price }}"
            >
                {{ $buttonText }}
            </button>
        </div>
    </div>
</div>