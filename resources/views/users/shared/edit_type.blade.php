<div class="border rounded p-4 mb-3">
  <div class="form-group row">
    {{ Form::label('userable_type', 'Rodzaj konta', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
      {{ Form::select('userable_type', [null => 'Pacjent', 'App\Employee' => 'Pracownik', 'App\Doctor' => 'Doktor'], $user->userable_type ?? null, 
      ['class' => 'form-control', 'id' => 'select_type']) }}
    </div>
  </div>
  <div id="pwz" class="form-group row" style="display:none;">
    {{ Form::label('licensure', 'PWZ', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
      {{ Form::text('licensure',  !empty($user) && $user->isDoctor ? $user->userable->licensure : null, ['class' => 'form-control']) }}
    </div>
  </div>
</div>

<script>
  const DOCTOR_VALUE = 'App\\Doctor';

  function updateType(value) {
    if (value === DOCTOR_VALUE) {
      $('#pwz').show();
    } else {
      $('#pwz').hide();
    }
  }

  (function() {
    const value = $('#select_type').val();
    updateType(value);
  })();

  $('#select_type').on('change', function(e) {
    updateType(e.target.value);
  });
</script>