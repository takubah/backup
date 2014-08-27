<!DOCTYPE html>
<html>
<head>
	<title>
		@section('title') 
			{{--$title--}} Baretshow
		@show
	</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @section('stylesheets')
    	{{ asmoyoAsset( 'css/bootstrap.min.css', 'public') }}
    	{{ asmoyoAsset( 'css/bootstrap-theme.min.css', 'public') }}
    	{{ asmoyoAsset( 'css/font-awesome.min.css', 'public') }}
    	{{ asmoyoAsset( 'css/style.css', 'public') }}
        {{--
        {{ HTML::style( route('assets.get', 'public/assets/css/bootstrap.min.css') ) }}
        {{ HTML::style( route('assets.get', 'public/assets/css/bootstrap-theme.min.css') ) }}
        {{ HTML::style( route('assets.get', 'public/assets/css/font-awesome.min.css') ) }}
        {{ HTML::style( route('assets.get', 'public/assets/css/style.css') ) }}
        --}}
    @show

    @section('analytics')
    	{{--
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', "{{ app('asmoyo.option')->getOption('web_ga') }}", "{{$_SERVER['SERVER_NAME']}}");
			ga('send', 'pageview');
		</script>
		--}}
    @show

</head>
<body>

	@include('asmoyoTheme.baretshow.partials.header')

	@section('banner')
		@include('asmoyoTheme.baretshow.partials.banner')
	@show

	@yield('structure')
	
	@section('footer')
		
		@include('asmoyoTheme.baretshow.partials.footer')

	@show

	@section('javascripts')
		{{ asmoyoAsset('js/jquery.min.js', 'public') }}
		{{ asmoyoAsset('js/bootstrap.min.js', 'public') }}
		{{ asmoyoAsset('js/holder.js', 'public') }}
		{{--
        {{ HTML::script( route('assets.get', 'public/assets/js/jquery.min.js') ) }}
        {{ HTML::script( route('assets.get', 'public/assets/js/bootstrap.min.js') ) }}
        {{ HTML::script( asset('/holder.js') ) }}
        --}}
    @show

</body>
</html>