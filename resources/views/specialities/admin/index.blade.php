@extends('layouts.default')
@section('title', 'Zarządzaj specjalnościami')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm text-capitalize">
  <form action="" class="form-inline">
    {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz specjalizację...'])}}
    <button type="submit" class="btn btn-primary">Filtruj</button>
  </form>
  <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Opcje</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($specialities as $speciality)
          <tr>
            <td>
              <a href="{{ url("specialities/{$speciality->id}") }}">{{ $speciality->name }}</a>
            </td>
            <td>
              {{ Form::open(['method' => 'DELETE', 'route' => ['specialities.destroy', $speciality->id]]) }}
                <a href="{{ url("specialities/{$speciality->id}/edit") }}" class="btn border btn-light ml-2">   
                  <i class="fas fa-edit mr-2"></i> Edytuj
                </a>
                <button class="btn btn-danger ml-2" onclick="return confirm('Czy chcesz usunąć specjalizację?')">
                  <i class="fas fa-trash mr-2"></i> Usuń
                </button>
              {{ Form::close() }}
            </td>
          </tr>
      @empty
        <tr>
          <td colspan="4">Brak specjalności</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  <a href="{{ url("specialities/create") }}" class="btn btn-success ml-2">Dodaj specjalizację</a>
</div>

@endsection