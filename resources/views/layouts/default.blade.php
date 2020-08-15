<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>EcoVita - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}"/>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        @include('layouts.shared.header')
        <div class="container p-4">
            @yield('content')
        </div>
    </body>
</html>