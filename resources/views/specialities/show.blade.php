<h1>{{ $speciality->name }}</h1>

<h2>Lekarze</h2>
<ul>
    @forelse ($speciality->doctors as $doctor)
    <li>
        <a href="{{ url('users', [$doctor->user->id]) }}">
            {{ $doctor->user->name }} {{ $doctor->user->surname }}
        </a>
    </li>
    @empty
        <li>No doctors</li>
    @endforelse
</ul>

