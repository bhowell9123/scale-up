<nav class="nav-primary" role="navigation" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between py-4">
      {{-- Logo --}}
      <a href="{{ home_url('/') }}" class="brand flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="ScaleUp Marketing Co" class="h-10">
      </a>

      {{-- Desktop Navigation --}}
      <div class="hidden lg:flex items-center space-x-8">
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav-menu flex items-center space-x-6',
          'container' => false,
        ]) !!}
        
        <a href="#contact" class="btn btn-primary">Get Started</a>
      </div>

      {{-- Mobile Menu Toggle --}}
      <button class="hamburger lg:hidden" id="mobile-menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    {{-- Mobile Navigation --}}
    <div class="nav-menu-mobile" id="mobile-menu">
      {!! wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'menu_class' => 'nav-menu-mobile-list',
        'container' => false,
      ]) !!}
    </div>
  </div>
</nav>