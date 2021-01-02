<div class="p-4 bg-white shadow-sm">
  @include('shared.errors')
  {{ Form::model($user, ['route' => ['settings.update_profile'], 'method' => 'PUT']) }}
    @include('settings.shared.form')
    {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
  {{ Form::close() }}
</div>