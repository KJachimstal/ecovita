@extends('layouts.default')

@section('content')
<div class="container">
  @include('settings.shared.tabs', ['active' => 'profile'])
  @if (Auth::user()->isPatient)
    @include('settings.forms.patient', ['user' => $user])
  @elseif (Auth::user()->isEmployee)
    @include('settings.forms.employee')
  @elseif (Auth::user()->isDoctor)
    @include('settings.forms.doctor')
  @endif
</div>
@endsection