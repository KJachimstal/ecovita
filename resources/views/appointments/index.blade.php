@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm">
  @include('shared.errors')
  <div class="multiple-items appointment-days">
    @foreach ($dailyAppointments as $key => $dailyAppointment)
      <div class="appointment-days__inner">
        <a href="#d{{ $key }}" class="appointment-days__item" data-count="{{ $dailyAppointment['count'] }}">
          <div class="appointment-days__date font-weight-bold">
            {{ $dailyAppointment['date']->formatLocalized('%d %b') }}
          </div>
          <div class="appointment-days__count {{ $dailyAppointment['count'] > 0 ? 'text-success' : 'text-muted' }}">
            {{ $dailyAppointment['count'] }}
          </div>
        </a>  
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
  {{ Form::hidden('speciality_id', app('request')->speciality_id) }}
  {{ Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny lekarz']) }}
  <button type="submit" class="btn btn-primary">Filtruj</button>
</form>

<div class="appointments mt-3">
  @foreach($dailyAppointments as $key => $dailyAppointment)
    @if($dailyAppointment['count'] > 0)
      <div class="appointments__item" id="d{{ $key }}">
        <header class="bg-success text-white">
          {{ $dailyAppointment['date']->formatLocalized('%d %B') }},
          <span class="text-capitalize">{{ $dailyAppointment['date']->formatLocalized('%A') }}</span>
        </header>  
        <div class="appointments__rows container">
          @forelse ($dailyAppointment['items'] as $appointment)
            <div class="appointments__row row py-2 my-1 border rounded">
                <div class="col-4">
                  <span class="appointments__hour rounded bg-light py-1 px-2 text-center d-inline-block font-weight-bold">
                    {{ \Carbon\Carbon::parse($appointment->begin_date)->format('H:i') }}
                  </span>
                </div>
                <div class="col-6">
                  {{ $appointment->doctorSpeciality->doctor->academic_degree }} <strong>{{ $appointment->doctorSpeciality->doctor->user->fullName }}</strong>
                </div>
                <div class="col-2">
                    <a href="{{ url("appointments/{$appointment->id}/enroll") }}" class="btn btn-sm border btn-light">
                      <i class="fas fa-calendar-check mr-2"></i>Zapisz się
                    </a>
                </div>
            </div>
          @empty

          @endforelse
        </div>
      </div>
    @endif
  @endforeach   
</div>
</div>
@endsection