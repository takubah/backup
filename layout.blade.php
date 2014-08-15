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
        </title>

        @section('stylesheets')
            {{asmoyoAsset( 'css/bootstrap.min.css')}}
            {{asmoyoAsset( 'css/bootstrap-theme.min.css')}}
            {{asmoyoAsset( 'css/font-awesome.min.css')}}
            {{asmoyoAsset( 'css/admin-style.css')}}
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
        
    @show

    @yield('structure')

    @section('footer')

    @show

    @section('javascripts')
        {{asmoyoAsset( 'js/jquery.min.js')}}
        {{asmoyoAsset( 'js/bootstrap.min.js')}}
    @show

</body>
</html>