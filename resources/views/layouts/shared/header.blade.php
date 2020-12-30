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
        <li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
        </li>
        <li class="nav-item {{ Request::is('users/*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('users.index') }}">Użytkownicy</a>
        </li>
        <li class="nav-item {{ Request::is('appointments*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('appointments.index') }}">Wizyty</a>
        </li>
        @auth
        <li class="nav-item {{ Request::is('users/*/appointments*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('users.appointments.index', ['user' => Auth::user()]) }}">Moje wizyty</a>
        </li>
        @endauth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Więcej
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">O nas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Kontakt</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"></a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
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