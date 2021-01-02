@extends('layouts.default')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('auth.register') }}</div>
        <div class="card-body">
          @include('shared.errors')
          {{ Form::open(['route' => ['register'], 'method' => 'POST']) }}
          <div class="border rounded p-4 mb-3">
            <div class="form-group row">
              {{ Form::label('first_name', 'Imię', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('first_name', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('last_name', 'Nazwisko', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::text('last_name', null, ['class' => 'form-control']) }}
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
              {{ Form::label('street_number', 'Numer domu', ['class' => 'col-sm-3 col-form-label']) }}
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
                {{ Form::password('password', ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="form-group row">
              {{ Form::label('password_confirmation', 'Potwierdź hasło', ['class' => 'col-sm-3 col-form-label']) }}
              <div class="col-sm-9">
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
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
