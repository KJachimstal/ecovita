<div class="form-group row">
  {{ Form::label('first_name', 'Imie', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('first_name', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('last_name', 'Nazwisko', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('last_name', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('pesel', 'Pesel', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('pesel', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('phone_number', 'Numer telefonu', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('phone_number', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('city', 'Miasto', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('city', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('post_code', 'Kod pocztowy', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('post_code', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('street', 'Ulica', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('street', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('street_number', 'Numer ulicy', ['class' => 'col-sm-2 col-form-label']) }}
  <div class="col-sm-10">
    {{ Form::text('street_number', null, ['class' => 'form-control']) }}
  </div>
</div>