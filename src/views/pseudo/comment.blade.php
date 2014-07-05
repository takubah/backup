@if($attr['type'] == 'list')	

	<div>	
		@foreach($repo as $r)
			<blockquote>
				<p>{{$r['title']}}</p>
				<p style="font-size:14px;">{{$r['content']}}</p>
				<footer> {{ $r['user']['fullname'] ?: $r['anonymous_name'] }} </footer>
			</blockquote>
		@endforeach
	</div>

@elseif($attr['type'] == 'media-object')

	<!-- Here is content -->

@elseif($attr['type'] == 'detail')

	<!-- Here is content -->

@endif