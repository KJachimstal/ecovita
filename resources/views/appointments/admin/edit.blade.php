@extends('layouts.default')
@section('title', 'Edytuj wizytę')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model($appointment, ['route' => ['appointments.update', $appointment->id], 'method' => 'PUT']) }}    
      <div class="form-group row">
        {{ Form::label('patient', 'Pacjent', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::select('patient',  [], null, ['class' => 'form-control patient_search']) }}
        </div>
      </div>
      <div class="form-group row">
        {{ Form::label('doctor', 'Doktor', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::select('doctor', [], null, ['class' => 'form-control doctor_search']) }}
        </div>
      </div>
      <div class="form-group row">
        {{ Form::label('begin_date', 'Data wizyty', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::date('begin_date',  null, ['class' => 'form-control']) }}
        </div>
      </div>
      <div class="form-group row">
        {{ Form::label('begin_date', 'Godzina wizyty', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::time('begin_date',  null, ['class' => 'form-control']) }}
        </div>
      </div>
      <div class="form-group row">
        {{ Form::label('is_available', 'Dostępna', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::checkbox('is_available',   $appointment->is_available ? true : false, ['class' => 'form-control']) }}
        </div>
      </div>
      <div class="mt-4 d-flex justify-content-center">
        {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
        <a href="{{ url("appointments") }}" class="btn border btn-light ml-2">Powrót</a>
      </div>
    {{ Form::close() }}
  </div>
</div>

<script type="text/javascript">
    $('.patient_search').select2({
        placeholder: 'Wyszukaj pacjenta...',
        ajax: {
            url: '/users/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name + ' ' + item.last_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('.doctor_search').select2({
        placeholder: 'Wyszukaj doktora...',
        ajax: {
            url: '/doctor_specialities/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name + ' ' + item.last_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
@endsection