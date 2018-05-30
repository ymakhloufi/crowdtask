<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Built Assets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div id="app">
    @guest
        @include('layouts.navbar-guest')
    @else
        @include('layouts.navbar-loggedin')
    @endguest

    <main class="py-4">
        @yield('content')
    </main>
</div>


<script src="{{ asset('js/app.js') }}"></script>
<script language="JavaScript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
