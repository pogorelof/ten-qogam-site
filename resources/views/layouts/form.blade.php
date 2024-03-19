<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body class="bg-green-100 p-10">
@if($previous = url()->previous())
    <a href="{{$previous}}" class="">
        <img src="img/back.svg" class="w-10 hover:scale-110">
    </a>
@else
    <a href="{{url()->route('home')}}" class="">
        <img src="img/back.svg" class="w-10 hover:scale-110">
    </a>
@endif
@yield('main')

</html>
