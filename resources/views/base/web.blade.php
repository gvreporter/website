<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;300;400;500;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>

    <title>@yield('seo::title') - GV Reporter</title>
    @yield('head')
</head>
<body>
    @section('nav')
        @include('navigation.navigation')
    @show
    
    @section('pre-app')
    
    @show
    <div class="app wrap">
        @section('app')
            Oh no, this shouldn't happen
        @show
    </div>
</body>
</html>