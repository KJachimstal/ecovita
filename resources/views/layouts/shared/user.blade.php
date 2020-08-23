@php
  $profileLinks = [
    'App\Patient' => route('patients.edit', ['patient' => Auth::user()->id]),
    // 'App\Doctor' => route('doctors.edit', ['doctor' => Auth::user()->id])
    'App\Doctor' => '...'
  ];
@endphp

<ul class="navbar-nav">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->name}}+{{Auth::user()->surname}}" width="30" height="30" class="rounded-circle mr-2">
      <strong>{{Auth::user()->name}} {{Auth::user()->surname}}</strong>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="{{ $profileLinks[Auth::user()->userable_type] }}">Edytuj profil</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}">Wyloguj się</a>
    </div>
  </li>   
</ul>