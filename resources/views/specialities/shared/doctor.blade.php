<li class="list-group-item">
  <a href="{{ url('users', [$doctor->user->id]) }}">
      {{ $doctor->user->first_name }} {{ $doctor->user->last_name }}
  </a>
</li>