<li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
</li>
<li class="nav-item {{ Request::is('appointments*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('appointments.index') }}">Wizyty</a>
</li>
<li class="nav-item {{ Request::is('users/*/appointments*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('users.appointments.index', ['user' => Auth::user()]) }}">Moje wizyty</a>
</li>
<li class="nav-item {{ Request::is('users/*/appointments*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('registers.index', ['user' => Auth::user()]) }}">Historia leczenia</a>
</li>