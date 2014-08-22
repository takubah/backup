@section('title') {{$title}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		{{$widget['item']['title']}} (widget: {{$widget['title']}})
		<small>{{$widget['item']['description']}}</small>
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<!-- <ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol> -->

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php $i = 0; ?>
				@if($content)
				@foreach($content as $c)
					<div class="item @if($i==0) active @endif">
						<img src="{{getMedia($c['file'])}}" style="width:100%; height:350px;">
						<div class="carousel-caption">
							<h3>{{$c['title']}}</h3>
							<p>{{$c['description']}}</p>
						</div>
					</div>
					<?php $i++; ?>
				@endforeach
				@endif
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>

	</div>
</div>