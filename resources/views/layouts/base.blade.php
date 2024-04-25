<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
@php
    $mode = Request::session()->get('mode');
@endphp
<body class="bg-gray-200 @if($mode == 'vi') text-xl @endif">

@include('includes.header')

@yield('main')

@include('includes.footer')

</body>

</html>
