@if($attr['type'] == 'list')

	<ul class="nav">

		@foreach($repo['items'] as $r)
			<li>
				<a href="{{route('post.show', $r['slug'])}}">
					{{$r['title']}}
				</a>
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