<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1, shrink-to-fit=yes">
        <meta name="description" content="Animal Sanctuary Wesbite">
        <meta name="author" content="Kwame Nytantakyi">

        <title>Animal Sanctuary - @yield('title')</title>


        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <!-- Font Awesome -->
        <script src="https://use.fontawesome.com/46deec112b.js"></script>
        <script src="https://kit.fontawesome.com/fd7889f5aa.js" crossorigin="anonymous"></script>
        
    </head>   
    
    <body>
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>    
</html>