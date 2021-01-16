@extends('layouts.default')
@section('title', 'Dodaj użytkownika')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(null, ['route' => ['users.store'], 'method' => 'POST']) }}
      @include('auth/shared/register_form')
      @include('users/shared/edit_type')
      <div class="mt-4 d-flex justify-content-center">
        {{ Form::submit('Dodaj użytkownika', ['class' => 'btn btn-success'])}}
        <a href="{{ url("users") }}" class="btn border btn-light ml-2">Powrót</a>
      </div>
    {{ Form::close() }}
  </div>
</div>
@endsection