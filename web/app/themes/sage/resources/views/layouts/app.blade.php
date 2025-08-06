<!doctype html>
<html @php(language_attributes())>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(do_action('get_header'))
  @php(wp_head())
  
  {{-- GoHighLevel Tracking Code --}}
  {!! get_field('ghl_tracking_code', 'option') !!}
</head>

<body @php(body_class())>
  @php(wp_body_open())

  <div id="app">
    @include('layouts.header')
    
    <main class="main">
      @yield('content')
    </main>
    
    @include('layouts.footer')
  </div>

  @php(do_action('get_footer'))
  @php(wp_footer())
</body>
</html>