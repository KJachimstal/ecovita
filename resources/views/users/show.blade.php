<h1>{{ $user->name }} {{ $user->surname }}</h1>

@if ($user->isPatient)
    <p>Ten użytkownik jest pacjentem.</p>
    <p>Pesel: {{ $user->userable->pesel }}</p>
@endif