@extends('layouts.default')
@section('title', 'Logi')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <div class="row">
    <div class="col-10">
      <form action="" class="form-inline mb-2">
        {{ Form::select('action', $actions, app('request')->action, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolna akcja']) }}
        {{ Form::select('user_id', $user ?? [], null, ['class' => 'form-control mr-sm-2 user_search', 'placeholder' => 'Wyszukaj użytkownika']) }}
        {{ Form::date('created_at', null, ['class' => 'form-control mr-sm-2 ml-sm-2']) }}
        @include('appointments.shared.search')
        <button type="submit" class="btn btn-primary ml-2">Filtruj</button>
      </form>
    </div>
  </div>
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Czas wystąpienia</th>
              <th scope="col">Użytkownik</th>   
              <th scope="col">Akcja</th>
              <th scope="col">Opis</th>
              <th scope="col">Opcje</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($logs as $log)
            <tr>
              <td>
                {{ $log->created_at }}
              </td>
              <td>
                {{ App\User::find($log->user_id)->fullName }}
              </td>
              <td>
                @lang("models/log.status.{$log->actionKey}")
              </td>
              <td>
                {{ $log->description }}
              </td>
              <td>
                <a href="{{ url("logs/{$log->id}") }}" class="btn btn-sm border btn-light">
                  <i class="fas fa-info"></i> Informacje
                </a>
              </td>
            </tr>
        @empty
          <tr>
            <td colspan="5">Brak wpisów</td>
          </tr>
        @endforelse
      </tbody>
  </table>
  {{ $logs->links() }}
</div>
@endsection