@extends('layouts.default')
@section('title', 'Zarządzaj gabinetami')
@section('content')
<h3 class="font-weight-bold mb-4">Zarządzaj gabinetami</h3>
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    <div class="row">
        <div class="col-10">
          <form action="" class="form-inline mb-3">
            {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2 col-6', 'placeholder' => 'Dowolny lekarz'])}}
            <button type="submit" class="btn btn-primary">Filtruj</button>
          </form>
        </div>
      </div>
  
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Lekarz</th>
                <th scope="col">Specjalizacja</th>
                <th scope="col">Opcje</th>
            </tr>
        </thead>
        <tbody>
          @forelse ($doctorSpecialities as $doctorSpeciality)
              <tr>
                <td>
                  {{ $doctorSpeciality->doctor->academic_degree }} <strong>{{ $doctorSpeciality->doctor->user->fullName }}</strong>
                </td>
                <td>
                  {{ $doctorSpeciality->speciality->name }}
                </td>
                <td>
                    <a href="{{ route('doctor_specialities.edit', [ 'doctor_speciality' => $doctorSpeciality ]) }}" class="btn btn-sm border btn-light">
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