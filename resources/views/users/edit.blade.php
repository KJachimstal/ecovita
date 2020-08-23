@extends('layouts.default')
@section('title', 'Edytuj profil')


@section('content')
	<form>
		<div class="form-group">
			{{ Form::label('email', 'Adres E-Mail') }}
			{{ Form::email('email', $user->email, ['class' => 'form-control']) }}
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		@if($user->isPatient)
		<div class="form-group">
			{{ Form::label('phone_number', 'Telefon') }}
			{{ Form::number('phone_number', Auth::User()->phone_number, ['class' => 'form-control']) }}
		</div>
		@endif
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection