@props([
    'action' => '#',
    'method' => 'POST',
    'id' => 'contact-form',
    'ghlForm' => null,
])

<form 
    action="{{ $action }}" 
    method="{{ strtolower($method) === 'get' ? 'GET' : 'POST' }}" 
    id="{{ $id }}"
    {{ $ghlForm ? "data-ghl-form={$ghlForm}" : '' }}
    {{ $attributes }}
>
    @if(strtolower($method) !== 'get' && strtolower($method) !== 'post')
        @method($method)
    @endif
    
    @if(strtolower($method) !== 'get')
        @csrf
    @endif
    
    {{ $slot }}
</form>