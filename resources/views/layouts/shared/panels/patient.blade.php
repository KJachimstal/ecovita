<li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
{{-- </li>
<li class="nav-item {{ Request::is('appointments*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('appointments.index') }}">Wizyty</a>
</li> --}}
<li class="nav-item {{ Request::is('users/*/appointments*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('users.appointments.index', ['user' => Auth::user()]) }}">Moje wizyty</a>
</li>
<li class="nav-item bg-success rounded pr-2 ml-2">
  <a href="{{ route('appointments.prepare_select_speciality') }}" class="nav-link text-white">
    <i class="fa fa-calendar-check mx-2"></i> Umów wizytę
  </a>
</li>