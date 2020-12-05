<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link{{ $active == 'profile' ? ' active' : '' }}" href="{{ route('settings.edit_profile') }}">Edytuj profil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link{{ $active == 'password' ? ' active' : '' }}" href="{{ route('settings.edit_password') }}">Zmień hasło</a>
  </li>
</ul>