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

    <link rel="stylesheet" href="/css/app.css">

    <title>@yield('seo::title') - GV Reporter</title>
    @yield('head')
</head>
<body>
    <div class="app wrap">
        @section('app')
            Oh no, this shouldn't happen
        @show
    </div>
</body>
</html>