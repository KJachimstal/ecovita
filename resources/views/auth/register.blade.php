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
          @include('auth/shared/register_form')
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
