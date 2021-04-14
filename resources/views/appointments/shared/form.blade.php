<div class="form-group row">
  {{ Form::label('user_id', 'Pacjent', ['class' => 'col-sm-3 col-form-label']) }}
  <div class="col-sm-9">
    {{ Form::select('user_id', $user ?? [], null, ['class' => 'form-control patient_search']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('doctor_speciality_id', 'Doktor', ['class' => 'col-sm-3 col-form-label']) }}
  <div class="col-sm-9">
    {{ Form::select('doctor_speciality_id', $doctor_speciality ?? [], null, ['class' => 'form-control doctor_speciality_search']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('begin_date', 'Data wizyty', ['class' => 'col-sm-3 col-form-label']) }}
  <div class="col-sm-9">
    {{ Form::input('dateTime-local', 'begin_date', $date ?? null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="mt-4 d-flex justify-content-center">
  {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
  {{-- <a href="{{ url("appointments") }}" class="btn border btn-light ml-2">Powrót</a> --}}
  <div onclick="window.history.back()" class="btn btn-light ml-2 border border-secondary"> Powrót</div>
</div>
@include('appointments.shared.search')