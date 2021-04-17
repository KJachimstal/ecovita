@extends('layouts.default')
@section('title', 'Szególy zapisu')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">
    <h3 class="font-weight-bold mb-4">Szegóły zapisu</h3>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Czas wykonania:</div>
        <div class="col-sm-9">{{ $log->created_at }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">ID:</div>
        <div class="col-sm-9">{{ $log->id }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Użytkownik:</div>
        <div class="col-sm-9">{{ App\User::find($log->user_id)->fullName }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">ID użytkownika:</div>
        <div class="col-sm-9">{{ $log->user_id }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Wykonana akcja:</div>
        <div class="col-sm-9">@lang("models/action.status.{$log->statusKey}")</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Adres URL:</div>
        <div class="col-sm-9">{{ $log->url }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Użyte parametry:</div>
        <div class="col-sm-9">{{ $log->params }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Przeglądarka:</div>
        <div class="col-sm-9">{{ $log->user_agent }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Adres IP:</div>
        <div class="col-sm-9">{{ $log->ip_address }}</div>
    </div>
    <div class="row">
        <div class="font-weight-bold mb-4 col-3">Opis:</div>
        <div class="col-sm-9">{{ $log->description }}</div>
    </div>
    @if ($log->details)
        <div class="row">
            <div class="font-weight-bold mb-4 col-3">Objekt:</div>
            <div class="col-sm-9"><code>{{ $log->details }}</code></div>
        </div>
        <div class="row">
            <div class="font-weight-bold mb-4 col-3">Typ obiektu:</div>
            <div class="col-sm-9">{{ $log->record_type }}</div>
        </div>
        <div class="row">
            <div class="font-weight-bold mb-4 col-3">ID obiektu:</div>
            <div class="col-sm-9">{{ $log->record_id }}</div>
        </div>
    @endif
</div>
@endsection