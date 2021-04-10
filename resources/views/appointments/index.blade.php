@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">

  <div class="multiple-items appointment-days">
    @foreach ($dailyAppointments as $dailyAppointment)
    {{-- {{ function scrollToElement() 
    {
        // $(window).scrollTop($("span:contains('{{ $dailyAppointment['date']->formatLocalized('%d %b') }}'):last").offset().top);
    } }} --}}
      <div class="appointment-days__inner">
        <div class="appointment-days__item">
          <div class="appointment-days__date font-weight-bold">
            {{ $dailyAppointment['date']->formatLocalized('%d %b') }}
          </div>
          <div class="appointment-days__count {{ $dailyAppointment['count'] > 0 ? 'text-success' : 'text-muted' }}">
            {{ $dailyAppointment['count'] }}
          </div>
        </div>  
      </div>
      @endforeach
  </div>
  
  <script type="text/javascript">
    $('.multiple-items').slick({
      infinite: false,
      slidesToShow: 11,
      slidesToScroll: 7
    });
  </script>

<form action="" class="form-inline">
  {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny lekarz'])}}
  {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}}
  <button type="submit" class="btn btn-primary">Filtruj</button>
</form>

<div class="appointments mt-3">
  @foreach($dailyAppointments as $dailyAppointment)
    <div class="appointments__item">
      <header class="bg-success text-white">
        {{ $dailyAppointment['date']->formatLocalized('%d %B') }}
        <span class="text-capitalize">{{ $dailyAppointment['date']->formatLocalized('%A') }}</span>
      </header>  
      <div class="appointments__rows container">
        @forelse ($appointments as $appointment)
          <div class="appointments__row row py-2 my-1 border rounded button__visibility">
              <div class="col-4">
                <span class="appointments__hour rounded bg-light py-1 px-2 text-center d-inline-block font-weight-bold">
                  {{ \Carbon\Carbon::parse($appointment->begin_date)->format('H:m') }}
                </span>
              </div>
              <div class="col-6">
                {{ $appointment->doctorSpeciality->doctor->user->userable->academic_degree }} {{ $appointment->doctorSpeciality->doctor->user->fullName }}
              </div>
              <div class="col-2">
                  <a href="{{ url("appointments/{$appointment->id}/enroll") }}" class="btn btn-sm border btn-light button__mouse">
                    <i class="fas fa-calendar-check mr-2"></i>Zapisz się
                  </a>
              </div>
          </div>
        @empty

        @endforelse
      </div>
    </div>
  @endforeach   
</div>


{{-- <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Termin</th>
            <th scope="col">Specjalizacja</th>   
            <th scope="col">Lekarz</th>
            <th scope="col">Opcje</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($appointments as $appointment)
          <tr>
            <td>
              {{ $appointment->begin_date }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->speciality->name }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->doctor->user->fullName }}
            </td>
            <td>
              <a href="{{ url("appointments/{$appointment->id}/enroll") }}" class="btn btn-sm border btn-light">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
      @empty
        <tr>
          <td colspan="4">Brak terminów</td>
        </tr>
      @endforelse
    </tbody>
</table>
{{ $appointments->links() }} --}}
</div>
@endsection