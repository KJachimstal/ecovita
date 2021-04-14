@extends('layouts.default')
@section('title', 'Edytuj doktora')
@section('content')
<div class="container">
  @include('users.shared.tabs', ['active' => 'specialities', 'user_id' => $user->id])
  {{ Form::model($user->userable, ['route' => ['users.update_doctor', $user->id], 'method' => 'POST']) }}
    <div class="border rounded p-4 mb-3">
      {{-- <div class="form-group row">
        {{ Form::label('licensure', 'PWZ', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::text('licensure',  null, ['class' => 'form-control']) }}
        </div>
      </div> --}}
      <div class="form-group row">
        {{ Form::label('specialities[]', 'Specjalności', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::select('specialities[]', $specialities,  null, ['class' => 'form-control', 'multiple']) }}
        </div>
      </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
      {{ Form::submit('Zapisz zmiany', ['class' => 'btn btn-success'])}}
      <a href="{{ url("users") }}" class="btn border btn-light ml-2">Powrót</a>
      <div onclick="window.history.back()" class="btn btn-light ml-2 border border-secondary"> Powrótttt</div>
    </div>
  {{ Form::close() }}
</div>
@endsection