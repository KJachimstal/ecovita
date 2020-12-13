@extends('layouts.default')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('auth.register') }}</div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          {{ Form::open(['route' => ['register'], 'method' => 'POST']) }}
          <div class="border rounded p-4 mb-3">
            <div class="form-group row">
              {{ Form::label('name', 'Imię', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('surname', 'Nazwisko', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('surname', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('pesel', 'Pesel', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('pesel', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('phone_number', 'Telefon', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('phone_number', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('city', 'Miasto', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('city', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('post_code', 'Kod pocztowy', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('post_code', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('street', 'Ulica', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('street', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('street_number', 'Numer ulicy', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('street_number', null, ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          <div class="border rounded p-4 mb-3">
            <div class="form-group row">
              {{ Form::label('email', 'Adres e-mail', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('email', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('password', 'Hasło', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('password', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('password_confirmation', 'Potwierdź hasło', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('password_confirmation', null, ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          <div class="text-center">
            {{ Form::submit('Zarejestruj', ['class' => 'btn btn-success'])}}
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
