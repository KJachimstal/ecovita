@extends('layouts.default')
@section('title', 'Dodaj spacjalizację')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(['route' => ['specialities.create'], 'method' => 'PUT']) }}
      @include('specialities.shared.form', ['speciality' => $speciality])
    {{ Form::close() }}
  </div>
</div>
@endsection