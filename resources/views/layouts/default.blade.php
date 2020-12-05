<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>EcoVita - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}"/>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
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
        <div class="container p-4">
          @yield('content')
        </div>
        @include('layouts.shared.footer')
    </body>
</html>