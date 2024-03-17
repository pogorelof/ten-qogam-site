<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body class="bg-green-100 p-10">
<a href="{{route('home')}}" class="">
    <img src="img/back.svg" class="w-10 hover:scale-110">
</a>
@yield('main')

</html>
