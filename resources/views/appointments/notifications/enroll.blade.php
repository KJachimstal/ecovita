@component('mail::message')
Witaj, <br/>
{{ $appointment->user->fullName}}<br/><br/>
Potwierdzamy rezerwację wizyty, która odbędzie się {{ $appointment->begin_date }}.<br/>


@component('mail::button', ['url' => 'localhost'])
Sprawdź swoje wizyty
@endcomponent

Prosimy o przybycie do placówki 15 minut przez zaplanowaną godziną rozpoczęcia porady lekarskiej.

Pozdrawiamy zespół,<br>
{{ config('app.name') }}
@endcomponent
