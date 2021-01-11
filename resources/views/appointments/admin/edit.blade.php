@extends('layouts.default')
@section('title', 'Edytuj wizytę')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model($appointment, ['route' => ['appointments.update', $appointment->id], 'method' => 'PUT']) }}    
      @include('appointments.shared.form')
    {{ Form::close() }}
  </div>
</div>
@endsection