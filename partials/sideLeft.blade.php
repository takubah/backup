@if( getSidebar('left') )
	@foreach( getSidebar('left') as $left )
		@if( $left['title'] )
			<h3 style="border-bottom:1px solid silver; padding:7px 3px;">
				{{$left['title']}}
			</h3>
		@endif
		<div>
			{{$left['content']}}
		</div>
	@endforeach
@endif