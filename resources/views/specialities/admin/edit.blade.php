@extends('layouts.default')
@section('title', 'Edytuj specjalizację')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Edycja specjalizacji</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model($speciality, ['route' => ['specialities.update', $speciality->id], 'method' => 'PUT']) }}
      @include('specialities.shared.form', ['speciality' => $speciality])
    {{ Form::close() }}
  </div>
</div>
@endsection