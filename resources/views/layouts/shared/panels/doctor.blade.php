@if (Auth::user()->is_panel_active) 
  <li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
  </li>
  <li class="nav-item {{ Request::is('users/*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">Użytkownicy</a>
  </li>
  <li class="nav-item {{ Request::is('appointments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('appointments.index') }}">Umówione wizyty</a>
  </li>
@else
  @include('layouts.shared.panels.patient')
@endif