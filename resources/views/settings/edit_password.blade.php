@extends('layouts.default')

@section('content')
<div class="container">
  @include('settings.shared.tabs', ['active' => 'password'])

  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')

    {{Form::open(['route' => ['settings.update_password'], 'method' => 'PUT'])}}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group row">
        {{ Form::label('password', 'Aktualne hasło', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-sm-10">
          {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
      </div>
     
      <div class="form-group row">
        {{ Form::label('new_password', 'Nowe hasło', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-sm-10">
          {{ Form::password('new_password', ['class' => 'form-control']) }}
        </div>
      </div>
  
      <div class="form-group row">
        {{ Form::label('new_password_confirmation', 'Potwórz nowe hasło', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-sm-10">
          {{ Form::password('new_password_confirmation', ['class' => 'form-control']) }}
        </div>
      </div> 
      {{ Form::submit('Zmień hasło', ['class' => 'btn btn-success'])}}
    {{Form::close()}}
  </div>
</div>
@endsection