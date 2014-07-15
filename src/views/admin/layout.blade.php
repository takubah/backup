<!DOCTYPE html>
<html>
<head>
    @section('header')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @section('title')
                Adminpanel 
            @show

            - Asmoyo Cms
        </title>

        @section('stylesheets')
            {{asmoyoAsset( 'css/bootstrap.min.css', 'admin')}}
            {{asmoyoAsset( 'css/bootstrap-theme.min.css', 'admin')}}
            {{asmoyoAsset( 'css/font-awesome.min.css', 'admin')}}
            
            {{--asmoyoAsset( 'css/style.css', 'css', true )--}}
            {{HTML::style('admin-style.css')}}
        @show

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        [endif]-->
    @show
</head>
<body>

    @section('navbar')
        @include('asmoyo::admin.partials.navbar')
    @show

    @yield('structure')

    @section('footer')

        <div class="col-lg-12">
            <div class="footer">
                © Copyright 2014 All Right Reserved | 
                <i> Powered by <a href="http://plensip.com"> plensip.com </a> </i>
            </div>
        </div>

    @show

    @section('javascripts')
        {{asmoyoAsset( 'js/jquery.min.js', 'admin')}}
        {{asmoyoAsset( 'js/bootstrap.min.js', 'admin')}}
        {{asmoyoAsset( 'js/asmoyo.js', 'admin')}}
    @show

</body>
</html>