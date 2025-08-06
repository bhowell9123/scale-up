@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="container mx-auto px-4 py-16">
      <h1 class="text-4xl font-bold mb-8">{!! get_the_title() !!}</h1>
      <div class="prose max-w-none">
        @php(the_content())
      </div>
    </div>
  @endwhile
@endsection