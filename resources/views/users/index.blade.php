@extends('layouts.default')
@section('title', 'Użytkownicy')
<div class="bg-white rounded p-4 mt-2 shadow-sm">    
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Imię</th>
              <th scope="col">Nazwisko</th>   
              <th scope="col">E-mail</th>
              <th scope="col">Typ konta</th>
              <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
            <tr>
              <td>
                {{ $user->first_name }}
              </td>
              <td>
                {{ $user->last_name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                {{ $user->userable_type }}
              </td>
              <td>
                <a href="{{ url("users/{$user->id}") }}">Podgląd</a>
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