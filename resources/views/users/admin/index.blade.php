@extends('layouts.default')
@section('title', 'Zarządzaj specjalizacjami')
@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <div class="row">
    <div class="col-8">
      <form action="" class="form-inline">
        {{Form::text('search', null, ['class' => 'form-control mr-sm-3', 'placeholder' => 'Wpisz słowo...'])}}
        <button type="submit" class="btn btn-primary">Filtruj</button>
      </form>
    </div>
    <div class="col-4 text-right">
      <a href="{{ url("users/create") }}" class="btn btn-success ml-2">Dodaj użytkownika</a>
    </div>
  </div>
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Imię i nazwisko</th>
              <th scope="col">E-mail</th>
              <th scope="col">Typ konta</th>
              <th scope="col">Opcje</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
            <tr>
              <td>
                {{ $user->fullName }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                {{ $user->userable_type }}
              </td>
              <td>
                {{-- {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) }} --}}
                  <a href="{{ url("users/{$user->id}/edit") }}" class="btn btn-sm border btn-light">
                    <i class="fas fa-user-edit"></i>
                  </a>
                  {{-- <button class="btn btn-sm btn-danger" onclick="return confirm('Czy chcesz usunąć użytkownika?')">
                    <i class="fas fa-trash"></i>
                  </button> --}}
                {{-- {{ Form::close() }} --}}
              </td>
            </tr>
        @empty
          <tr>
            <td colspan="4">Brak użytkowników</td>
          </tr>
        @endforelse
      </tbody>
  </table>
  {{ $users->links() }}
</div>
@endsection