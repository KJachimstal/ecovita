<li class="list-group-item">
  <a href="{{ url('users', [$doctor->user->id]) }}">
      {{ $doctor->user->name }} {{ $doctor->user->surname }}
  </a>
</li>