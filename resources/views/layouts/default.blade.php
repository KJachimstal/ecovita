<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}"/>
    </head>
    <body>
        asdsa
        @section('sidebar')
            This is the master sidebar
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>