{{-- @php
  $profileLinks = [
    'App\Patient' => route('patients.edit', ['patient' => Auth::user()->id]),
    // 'App\Doctor' => route('doctors.edit', ['doctor' => Auth::user()->id])
    'App\Doctor' => '...'
  ];
@endphp --}}

<ul class="navbar-nav">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->first_name}}+{{Auth::user()->last_name}}" width="30" height="30" class="rounded-circle mr-2">
      <strong>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</strong>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
      @if (Auth::User()->isEmployee || Auth::User()->isDoctor)
        <a class="dropdown-item" href="{{ route('settings.switch_panel') }}">Przełącz panel</a>
      @endif
      <a class="dropdown-item" href="{{ route('settings.edit_profile') }}">Ustawienia</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}">Wyloguj się</a>
    </div>
  </li>
</ul>