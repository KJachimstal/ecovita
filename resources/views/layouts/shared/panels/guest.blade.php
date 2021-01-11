<li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
</li>
{{-- <li class="nav-item {{ Request::is('users/*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('users.index') }}">Użytkownicy</a>
</li> --}}
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