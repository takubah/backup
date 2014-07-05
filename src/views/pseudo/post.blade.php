@if($attr['type'] == 'list')	

	<ul class="nav">

		@foreach($repo as $r)
			<li>
				<a href="">
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