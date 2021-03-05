@extends('layouts.default')
@section('title', 'Historia Leczenia')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">    
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Data</th>
              <th scope="col">Lekarz</th>
              <th scope="col">Opis</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($treatment_histories as $treatment)
            <tr>
              <td>
                {{ $treatment->id }}
              </td>
              <td>
                {{ $treatment->full_name }}
              </td>
              <td>
                {{ $treatment->description }}
              </td>
            </tr>
        @empty
          <tr>
            <td colspan="4">Brak wpisów</td>
          </tr>
        @endforelse
      </tbody>
  </table>
  {{ $treatment_histories->links() }}
</div>
@endsection