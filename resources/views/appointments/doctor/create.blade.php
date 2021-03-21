@extends('layouts.default')
@section('title', 'Stwórz wizytę')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Dodawanie wizyty</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(null, ['route' => ['appointments.store'], 'method' => 'POST']) }}    
      @include('appointments.shared.form')
    {{ Form::close() }}
  </div>
</div>
@endsection