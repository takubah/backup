@if($attr['type'] == 'list')

	<ul class="nav">

		@foreach($repo as $r)
			<li>
				<a href="{{route('category.show', $r['slug'])}}">
					{{$r['title']}}
				</a>
				@if( $r['child'] )
					<ul>
						@foreach($r['child'] as $child)
							<li>
								<a style="cursor:move;">
									{{$child['title']}}
								</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
		@endforeach

	</ul>

@elseif($attr['type'] == 'grid')

	<!-- Here is content -->

@elseif($attr['type'] == 'media-object')

	<!-- Here is content -->

@elseif($attr['type'] == 'detail')

	<!-- Here is content -->

@elseif($attr['type'] == 'inline')

	<!-- Here is content -->

@endif