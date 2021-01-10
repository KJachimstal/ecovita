<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link{{ $active == 'profile' ? ' active' : '' }}" href="{{ route('users.edit', $user_id)  }}">Edytuj profil</a>
  </li>
  @if ($user->is_doctor)
  <li class="nav-item">
    <a class="nav-link{{ $active == 'specialities' ? ' active' : '' }}" href="{{ route('users.edit_doctor', $user) }}">Edytuj specjalne</a>
  </li>
  @endif
</ul>