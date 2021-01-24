@extends('layouts.default')
@section('title', 'Logi')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">    
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">ID</th>
              {{-- <th scope="col">Data i czas</th> --}}
              <th scope="col">Imię i nazwisko</th>   
              <th scope="col">Adres IP</th>
              <th scope="col">Opis</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($logs as $log)
            <tr>
              <td>
                {{ $log->id }}
              </td>
              {{-- <td>
                {{ $log->timestamps }}
              </td> --}}
              <td>
                {{ $log->full_name }}
              </td>
              <td>
                {{ $log->ip_address }}
              </td>
              <td>
                {{ $log->description }}
              </td>
            </tr>
        @empty
          <tr>
            <td colspan="4">Brak wpisów</td>
          </tr>
        @endforelse
      </tbody>
  </table>
  {{ $logs->links() }}
</div>
@endsection