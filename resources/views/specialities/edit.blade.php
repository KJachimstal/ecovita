@extends('layouts.default')

@section('content')
<div class="container">

<div class="p-4 bg-white shadow-sm">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  {{ Form::model($speciality, ['route' => ['specialities.update', $speciality->id], 'method' => 'PUT']) }}
    <div class="form-group row">
      {{ Form::label('speciality_name', 'Nazwa specjalności', ['class' => 'col-sm-2 col-form-label']) }}
      <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
      {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
    </div>
  {{ Form::close() }}
</div>
</div>
@endsection