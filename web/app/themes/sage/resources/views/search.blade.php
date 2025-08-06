@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">
      {!! sprintf(__('Search Results for: %s', 'sage'), get_search_query()) !!}
    </h1>

    @if (! have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      
      {!! get_search_form(false) !!}
    @endif

    @while(have_posts()) @php(the_post())
      <article @php(post_class('mb-12'))>
        <header>
          <h2 class="text-2xl font-bold mb-4">
            <a href="{{ get_permalink() }}">
              {!! get_the_title() !!}
            </a>
          </h2>
        </header>

        <div class="prose max-w-none mb-4">
          @php(the_excerpt())
        </div>

        <footer>
          <a href="{{ get_permalink() }}" class="btn btn-secondary">
            {{ __('Read More', 'sage') }}
          </a>
        </footer>
      </article>
    @endwhile

    {!! get_the_posts_navigation() !!}
  </div>
@endsection