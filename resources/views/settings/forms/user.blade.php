<div class="p-4 bg-white shadow-sm">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  {{ Form::model($user, ['route' => ['settings.update_profile'], 'method' => 'PUT']) }}
    <div class="form-group row">
      {{ Form::label('name', 'Imie', ['class' => 'col-sm-2 col-form-label']) }}
      <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'disabled']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('surname', 'Nazwisko', ['class' => 'col-sm-2 col-form-label']) }}
      <div class="col-sm-10">
        {{ Form::text('surname', null, ['class' => 'form-control', 'disabled']) }}
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
    {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
  {{ Form::close() }}
</div>