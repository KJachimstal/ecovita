<div class="form-group row">
  {{ Form::label('speciality_name', 'Nazwa specjalności', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="mt-4 d-flex justify-content-center">
  {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
  <a href="{{ url("specialities") }}" class="btn border btn-light ml-2">Powrót</a>
</div>
