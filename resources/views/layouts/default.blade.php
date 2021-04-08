<!-- Stored in resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>EcoVita - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}"/>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        {{-- <script type="text/javascript" src="{{ asset('js/search.js') }}"></script> --}}
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/slick-theme.css') }}" />
    </head>
    <body>
        @include('layouts.shared.header')
        @if ($message = Session::get('success'))
          <div class="container mt-3 px-3">
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
            </div>
          </div>
        @endif
        @if ($message = Session::get('error'))
          <div class="container mt-3 px-3">
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
            </div>
          </div>
        @endif
        <div class="container p-4">
          @yield('content')
        </div>
        @include('layouts.shared.footer')
    </body>
</html>