@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-32 text-center">
    <h1 class="text-5xl font-bold mb-6">404</h1>
    <h2 class="text-3xl mb-8">{{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}</h2>
    
    <p class="mb-8">{{ __('It looks like nothing was found at this location.', 'sage') }}</p>
    
    <a href="{{ home_url('/') }}" class="btn btn-primary">
      {{ __('Back to Home', 'sage') }}
    </a>
  </div>
@endsection