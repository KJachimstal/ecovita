@extends('layouts.default')
@section('title', 'Moje wizyty')


@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Termin</th>
            <th scope="col">Specjalizacja</th>   
            <th scope="col">Lekarz</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
      @forelse ($appointments as $appointment)
          <tr>
            <td>
              {{ $appointment->begin_date }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->speciality->name }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->doctor->user->fullName }}
            </td>
            <td>
              <a href="{{ url("users/{$appointment->user_id}/appointments/{$appointment->id}/cancel") }}">Odwołaj wizytę</a>
            </td>
          </tr>
      @empty
        <tr>
          <td colspan="4">Brak terminów</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection