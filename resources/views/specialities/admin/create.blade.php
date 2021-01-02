@extends('layouts.default')
@section('title', 'Dodaj specjalizację')
@section('content')
<div class="container">
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(null, ['route' => ['specialities.store'], 'method' => 'POST']) }}
      @include('specialities.shared.form')
    {{ Form::close() }}
  </div>
</div>
@endsection