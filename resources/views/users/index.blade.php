@extends('layouts.default')
@section('title', 'Użytkownicy')


@section('content')
@auth
@if ((Auth::user()->is_panel_active) && (Auth::user()->is_employee))
  @include('users.admin.index')
@endauth
@else
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    {{-- <form action="" class="form-inline">
      {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz specjalizację...'])}}
      {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz lekarza...'])}}
      {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}}
      <button type="submit" class="btn btn-primary">Filtruj</button>
    </form> --}}
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>   
                <th scope="col">E-mail</th>
                <th scope="col">Typ konta</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
              <tr>
                <td>
                  {{ $user->first_name }}
                </td>
                <td>
                  {{ $user->last_name }}
                </td>
                <td>
                  {{ $user->email }}
                </td>
                <td>
                  {{ $user->userable_type }}
                </td>
                <td>
                  <a href="{{ url("users/{$user->id}") }}">Podgląd</a>
                </td>
              </tr>
          @empty
            <tr>
              <td colspan="4">Brak użytkowników</td>
            </tr>
          @endforelse
        </tbody>
    </table>
  </div>
@endif

@endsection