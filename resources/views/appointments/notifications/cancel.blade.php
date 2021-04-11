@component('mail::message')
Witaj, <br/>
{{ $appointment->user->fullName}}<br/><br/>
Potwierdzamy rezygnację z wizyty, która zaplanowana była w dniu {{ $appointment->begin_date }}.<br/>

@component('mail::button', ['url' => 'localhost'])
Sprawdź swoje wizyty
@endcomponent

Pozdrawiamy,<br>
zespół {{ config('app.name') }}
@endcomponent
