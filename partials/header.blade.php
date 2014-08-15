<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{route('home.index')}}">
				{{$web['web_title']}}
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if($navbar)
				@foreach($navbar as $nav)
					<li>
						<a href="{{$nav['url']}}">
							{{$nav['title']}}
						</a>
					</li>
				@endforeach
				@endif
			</ul>

			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">
					Submit
				</button>
			</form>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

@section('banner')
	@include('asmoyoTheme.standard.partials.banner')
@show