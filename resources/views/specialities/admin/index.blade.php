@extends('layouts.default')
@section('title', 'Zarządzaj specjalnościami')
@section('content')
<h3 class="font-weight-bold mb-4">Zarządzanie specjalnościami</h3>
<div class="bg-white rounded p-4 mt-2 shadow-sm text-capitalize">
  <div class="row">
    <div class="col-8">
      <form action="" class="form-inline mb-2">
        {{Form::text('name', null, ['class' => 'form-control mr-sm-3', 'placeholder' => 'Wpisz nazwę specjalizacji...'])}}
        <button type="submit" class="btn btn-primary">Filtruj</button>
      </form>
    </div>
    <div class="col-4 text-right">
      <a href="{{ url("specialities/create") }}" class="btn btn-success ml-2">Dodaj specjalizację</a>
    </div>
  </div>
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
  {{ $specialities->links() }}
</div>

@endsection