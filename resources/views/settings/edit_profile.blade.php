@extends('layouts.default')

@section('content')
<div class="container">
  @include('settings.shared.tabs', ['active' => 'profile'])
  @include('settings.forms.user', ['user' => $user])
  @if (Auth::user()->isEmployee)
    @include('settings.forms.employee')
  @elseif (Auth::user()->isDoctor)
    @include('settings.forms.doctor')
  @endif
</div>
@endsection