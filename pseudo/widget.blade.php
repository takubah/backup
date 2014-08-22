@if( $attr['name'] == 'listing' )

	@if($widget['item']['content'])
		<div class="list-group">
			@foreach($widget['item']['content'] as $c)
				<a @if($c['link']) href="{{$c['link']}}" @endif class="list-group-item">
					<span class="badge">
						<i class="fa fa-arrow-right"></i>
					</span>
					<h4 class="list-group-item-heading">{{$c['title']}}</h4>
					<p class="list-group-item-text">{{$c['description']}}</p>
				</a>
			@endforeach
		</div>
	@endif
	
@elseif( $attr['name'] == 'text' )
	
	{{$widget['item']['content']['text']}}

@elseif( $attr['name'] == 'search' )
	
	<form class="form-horizontal">
		{{Form::text('keyword', null, array('class' => 'form-control', 'placeholder' => 'Keyword..'))}}
	</form>

@elseif( $attr['name'] == 'banner' )
	
	@if($widget['item']['content'])
		<div id="banner_{{$widget['item']['id']}}" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php $i = 0; ?>
				@foreach($widget['item']['content'] as $c)
					<li data-target="#banner_{{$widget['item']['id']}}" data-slide-to="{{$i}}" class="@if($i==0) active @endif"></li>
				<?php $i++; ?>
				@endforeach
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php $i = 0; ?>
				@foreach($widget['item']['content'] as $c)
					<div class="item @if($i==0) active @endif">
						<img src="{{getMedia($c['file'])}}" style="width:100%;">
						<div class="carousel-caption">
							<h3>{{$c['title']}}</h3>
							<p>{{$c['description']}}</p>
						</div>
					</div>
					<?php $i++; ?>
				@endforeach
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#banner_{{$widget['item']['id']}}" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#banner_{{$widget['item']['id']}}" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	@endif

@endif