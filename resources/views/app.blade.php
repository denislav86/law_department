<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link type="text/css" href="{{ URL::asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body>

        @include('partials.nav')

        @yield('content')


        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ URL::asset('js/script.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.datetimepicker.full.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </body>
</html>
