@extends('layouts.default')
@section('title', 'Edytuj profil')


@section('content')
@include('shared.errors')
  {{ Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'PUT']) }}
    {{ Form::label('pesel', 'Pesel') }}
    {{ Form::text('pesel', null, ['class' => 'form-control']) }}
  
    {{ Form::label('phone_number', 'Numer telefonu') }}
    {{ Form::text('phone_number', null, ['class' => 'form-control']) }}

    {{ Form::label('city', 'Miasto') }}
    {{ Form::text('city', null, ['class' => 'form-control']) }}

    {{ Form::label('post_code', 'Kod pocztowy') }}
    {{ Form::text('post_code', null, ['class' => 'form-control']) }}

    {{ Form::label('street', 'Ulica') }}
    {{ Form::text('street', null, ['class' => 'form-control']) }}

    {{ Form::label('street_number', 'Numer ulicy') }}
    {{ Form::text('street_number', null, ['class' => 'form-control']) }}

    {{ Form::submit('Wiślij', ['class' => 'btn btn-success'])}}
  {{ Form::close() }}
@endsection