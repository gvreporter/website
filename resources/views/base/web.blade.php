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
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/favicon.ico') }}">  
    <link rel="shortcut icon" type="image/png" href="{{ URL::to('/favicon.png') }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    {{-- Toast lib --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    @yield('head')

    {{-- Primary meta tags --}}
    <title>@yield('seo::title') - GV Reporter</title>
    <meta name="title" content="@yield('seo::title')">
    <meta name="description" content="@yield('seo::desc', 'Il giornale scolastico del Gobetti Volta. Fatto dagli studenti, per gli studenti')">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::to('/') }}">
    <meta property="og:title" content="@yield('seo::title')">
    <meta property="og:description" content="@yield('seo::desc', 'Il giornale scolastico del Gobetti Volta. Fatto dagli studenti, per gli studenti')">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ URL::to('/') }}">
    <meta property="twitter:title" content="@yield('seo::title')">
    <meta property="twitter:description" content="@yield('seo::desc', 'Il giornale scolastico del Gobetti Volta. Fatto dagli studenti, per gli studenti')">
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

    @section('script')
    @show

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>