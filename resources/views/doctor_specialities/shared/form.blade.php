
<div class="form-group row">
{{ Form::label('doctor_id', 'Doktor', ['class' => 'col-sm-3 col-form-label']) }}
<div class="col-sm-9">
    {{ Form::select('doctor_id', $doctor ?? [], null, ['class' => 'form-control doctor_search']) }}
</div>
</div>
<div class="form-group row">
{{ Form::label('speciality_id', 'Specjalizacja', ['class' => 'col-sm-3 col-form-label']) }}
<div class="col-sm-9">
    {{ Form::select('speciality_id', $specialities, null, ['class' => 'form-control']) }}
</div>
</div>

@foreach ($days as $index => $day)

<div class="form-group row border rounded pb-2">
{{ Form::label('speciality_id', $day, ['class' => 'col-sm-3 col-form-label ']) }}
<div class="col-sm-9">
    <div class="row">
        <div class="col">
        {{ Form::label('day_id', 'Godzina rozpoczęcia', ['class' => 'col-form-label ']) }}
        {{ Form::input('time', 'start[]', empty($schedule[$index]['start']) ? null : $schedule[$index]['start'], ['class' => 'form-control']) }}
        </div>
        <div class="col">
        {{ Form::label('day_id', 'Godzina zakończenia', ['class' => ' col-form-label ']) }}
        {{ Form::input('time', 'stop[]', empty($schedule[$index]['stop']) ? null : $schedule[$index]['stop'], ['class' => 'form-control']) }}
        </div>
    </div>
</div>
</div>

@endforeach

<div class="mt-4 d-flex justify-content-center">
{{ Form::submit('Zapisz', ['class' => 'btn btn-success'])}}
<a href="{{ url("doctor_specialities") }}" class="btn border btn-light ml-2">Powrót</a>
</div>
@include('appointments.shared.search')
