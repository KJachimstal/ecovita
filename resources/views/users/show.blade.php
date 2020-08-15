<h1>{{ $user->name }} {{ $user->surname }}</h1>
<p>{{ $user->email }}</p>

@if ($user->isPatient)
    <p>Ten użytkownik jest pacjentem.</p>
    <p>Pesel: {{ $user->userable->pesel }}</p>
@endif

@if ($user->isDoctor)
    <p>Ten użytkownik jest Doktorem.</p>
    <p>PWZ: {{ $user->userable->licensure }}</p>

    <h2>Specjalności:</h2>
    <ul>
        @forelse ($user->userable->specialities as $speciality)
            <li>
                <a href="{{ url('specialities', [$speciality->id]) }}">
                    {{ $speciality->name }}
                </a>
            </li>
        @empty
            <li>No specialities</li>
        @endforelse
    </ul>
@endif