<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
         <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Blog</title>
        <link rel="icon" href="{{URL::asset('favicon.ico')}}">
        <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/mdb.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/main.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/jquery.Jcrop.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css')}}" rel="stylesheet">     
        <!-- Это нужно для подсветки кода в статьях ---------------------------------- -->
        <script src={{URL::asset('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js')}}></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>

    <body aria-busy="true">
        @include('inc.header')
        @include('inc.navigation')
        @include('inc.message')

        <div class='main-field'>  
            <div class='container-fluid ' >
                <div class='container data-field'>
                    <div class='row'>  
                        @yield('content') 
                    </div>
                </div>
            </div>
        </div>

        @section('footer')
            @include('footer')
        @show
        

        <!-- Bootstrap core JavaScript ================================================== -->
    <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/crop.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/javascript.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.Jcrop.min.js')}}"></script>

    <div class="hiddendiv common"></div>

    <script>
        new WOW().init();
    </script>
    </body>
    
</html>

