<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title')</title>
</head>

@php
    $mode = Request::session()->get('mode');
@endphp

<body class="bg-green-100 p-10 @if($mode == 'vi') text-xl @endif">
    <a href="{{url()->route('home')}}" class="">
        <img src="img/back.svg" class="w-10 hover:scale-110">
    </a>
@yield('main')

</html>
