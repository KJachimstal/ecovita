<div class="col-3">
  <div class="card mb-4 bg-white rounded shadow-sm">
    <div class="card-body">
      <h5 class="card-title font-weight-bold text-capitalize" style="height: 60px">{{ $speciality->name }}</h5>
      <a href="{{ url('specialities', [$speciality->id]) }}" class="btn btn-light">
        Sprawdź lekarzy
      </a>
    </div>
  </div>
</div>