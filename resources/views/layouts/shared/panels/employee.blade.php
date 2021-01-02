@if (Auth::user()->is_panel_active) 
  <li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('specialities.index') }}">Zarządzaj specjalnościami</a>
  </li>
  <li class="nav-item {{ Request::is('users/*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">Zarządzaj urzytkownikami</a>
  </li>
  <li class="nav-item {{ Request::is('appointments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('appointments.index') }}">Zarządzaj wizytami</a>
  </li>
@else
  @include('layouts.shared.panels.patient')
@endif