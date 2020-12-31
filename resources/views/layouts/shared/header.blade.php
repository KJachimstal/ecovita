<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand text-primary" href="/">
      <img src="{{ asset('images/logo.png') }}" alt="EcoVita" height="30" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a class="nav-link" href="/">Strona główna <span class="sr-only">(current)</span></a>
        </li>
        @if (Auth::guest())
          @include('layouts.shared.panels.guest')
        @elseif (Auth::user()->isDoctor)
          @include('layouts.shared.panels.doctor')
        @elseif (Auth::user()->isEmployee)
          @include('layouts.shared.panels.employee')
        @else
          @include('layouts.shared.panels.patient')
        @endif
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @guest
        <li class="nav-item {{ Request::is('login*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('login') }}">Zaloguj się</a>
        </li>
        <li class="nav-item {{ Request::is('register*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('register') }}">Utwórz konto</a>
        </li>
        @endguest

        @auth
          @include('layouts.shared.user')
        @endauth
      </ul>
    </div>
  </div>
</nav>