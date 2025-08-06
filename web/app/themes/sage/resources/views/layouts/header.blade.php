<header class="banner fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
  <nav class="nav-primary" role="navigation" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between py-4">
        {{-- Logo --}}
        <a href="{{ home_url('/') }}" class="brand flex items-center">
          <img src="{{ asset('images/logo.png') }}" alt="ScaleUp Marketing Co" class="h-10 w-auto">
        </a>

        {{-- Desktop Navigation --}}
        <div class="hidden lg:flex items-center space-x-8">
          <a href="#challenge" class="nav-link">Your Challenge</a>
          <a href="#solution" class="nav-link">Our Solution</a>
          <a href="#results" class="nav-link">What You Get</a>
          <a href="#pricing" class="nav-link">Results</a>
          <a href="#process" class="nav-link">How it Works</a>
          <a href="#contact" class="btn btn-primary">Get Started</a>
        </div>

        {{-- Mobile Menu Toggle --}}
        <button class="hamburger lg:hidden flex flex-col justify-center items-center w-8 h-8" id="mobile-menu-toggle">
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
        </button>
      </div>

      {{-- Mobile Navigation --}}
      <div class="nav-menu-mobile fixed top-0 right-0 h-full w-4/5 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-40" id="mobile-menu">
        <div class="p-6">
          <div class="flex justify-end mb-8">
            <button class="close-menu text-2xl" id="close-mobile-menu">&times;</button>
          </div>
          <nav class="space-y-6">
            <a href="#challenge" class="block text-lg font-medium">Your Challenge</a>
            <a href="#solution" class="block text-lg font-medium">Our Solution</a>
            <a href="#results" class="block text-lg font-medium">What You Get</a>
            <a href="#pricing" class="block text-lg font-medium">Results</a>
            <a href="#process" class="block text-lg font-medium">How it Works</a>
            <a href="#contact" class="btn btn-primary w-full justify-center mt-8">Get Started</a>
          </nav>
        </div>
      </div>
    </div>
  </nav>
</header>