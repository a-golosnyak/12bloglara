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
        <link rel="icon" href="../../favicon.ico">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />       
        <link href="ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
        <!-- Это нужно для подсветки кода в статьях ---------------------------------- -->
        <script src="ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>

    <body aria-busy="true">
        
        @include('header')
        @include('navigation')

        @yield('content')

        @include('footer')

        <!-- Bootstrap core JavaScript
    ================================================== -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/crop.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>

    <div class="hiddendiv common"></div>

    <script>
        new WOW().init();
    </script>
    </body>
    
</html>

