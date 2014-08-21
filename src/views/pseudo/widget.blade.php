@if( $attr['slug'] == 'listing' )
	<div class="list-group">
		@if($widget['item']['content'])
		@foreach($widget['item']['content'] as $c)
			<a @if($c['link']) href="{{$c['link']}}" @endif class="list-group-item">
				<span class="badge">
					<i class="fa fa-arrow-right"></i>
				</span>
				<h4 class="list-group-item-heading">{{$c['title']}}</h4>
				<p class="list-group-item-text">{{$c['description']}}</p>
			</a>
		@endforeach
		@endif
	</div>
@elseif( $attr['slug'] == 'text' )
	
	{{$widget['item']['content']['text']}}

@endif