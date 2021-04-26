@extends('layouts.default')
@section('title', 'Zarządzaj gabinetami')
@section('content')
<h3 class="font-weight-bold mb-4">Zarządzaj gabinetami</h3>
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    <div class="row">
        <div class="col-10">
          <form action="" class="form-inline mb-3">
            {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2 col-4', 'placeholder' => 'Dowolny lekarz'])}}
            {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2 col-4', 'placeholder' => 'Dowolna specjalizacja'])}}
            <button type="submit" class="btn btn-primary">Filtruj</button>
          </form>
        </div>
        <div class="col-2 text-right">
          <a href="{{ route('doctor_specialities.create') }}" class="btn btn-success ml-2">Dodaj gabinet</a>
        </div>
      </div>
  
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID gabinetu</th>
                <th scope="col">Lekarz</th>
                <th scope="col">Specjalizacja</th>
                <th scope="col">Opcje</th>
            </tr>
        </thead>
        <tbody>
          @forelse ($doctorSpecialities as $doctorSpeciality)
              <tr>
                <td>
                  {{ $doctorSpeciality->id}}
                </td>
                <td>
                  {{ $doctorSpeciality->doctor->academic_degree }} <strong>{{ $doctorSpeciality->doctor->user->fullName }}</strong>
                </td>
                <td>
                  {{ $doctorSpeciality->speciality->name }}
                </td>
                <td>
                      <a href="{{ route('doctor_specialities.edit', ['doctor_speciality' => $doctorSpeciality->id]) }}" class="btn btn-sm border btn-light">
                        <i class="fas fa-edit"></i> Edytuj
                      </a>
                </td>
              </tr>
          @empty
            <tr>
              <td colspan="4">Brak dostępnych gabinetów</td>
            </tr>
          @endforelse
        </tbody>
    </table>
    {{ $doctorSpecialities->links() }}
  </div>
@endsection