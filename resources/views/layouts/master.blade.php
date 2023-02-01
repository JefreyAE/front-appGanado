<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-CV5G60Q6ZF"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-CV5G60Q6ZF');
        </script>
        <title>@yield('title')</title>
        <link rel="icon" type="favicon/x-icon" href="{{asset("img/supertux.jpg")}}" />
        <link rel="stylesheet" type="text/css" href="{{asset("css/main.css")}}">
        <script type="text/javascript" src="{{asset("js/jsmain.js")}}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Registro y control de estadísticas para un hato de ganado vacuno" >
        <meta name="keywords" content="ganado,registro,vacuno,estadísticas">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid mt-2">
            <div class="justify-content-center">
                <header id="header" class="col-md-12">   
                    @yield('title_header')
                    @yield('header')
                </header>
             
                <div id="container-all" class="wrap col-md-12">
                    @yield('content')
                </div>

                <div class="clearfix"></div>
                @yield('footer')
                <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

            </div>
        </div>
    </body>
</html>
