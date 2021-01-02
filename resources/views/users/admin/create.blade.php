@extends('layouts.default')
@section('title', 'Dodaj użytkownika')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(null, ['route' => ['users.store'], 'method' => 'POST']) }}
      @include('auth/shared/register_form')
      <div class="border rounded p-4 mb-3">
        <div class="form-group row">
          {{ Form::label('userable_type', 'Rodzaj konta', ['class' => 'col-sm-3 col-form-label']) }}
          <div class="col-sm-9">
            {{ Form::select('userable_type', array('App\Patient' => 'Pacjent', 'App\Employee' => 'Pracownik', 'App\Doctor' => 'Doktor'), 'S', ['class' => 'form-control']) }}
          </div>
        </div>
      <div class="mt-4 d-flex justify-content-center">
        {{ Form::submit('Dodaj użytkownika', ['class' => 'btn btn-success'])}}
        <a href="{{ url("users") }}" class="btn border btn-light ml-2">Powrót</a>
      </div>
    {{ Form::close() }}
  </div>
</div>
@endsection