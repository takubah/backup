@if($layout['sideLeft'])

	@foreach($layout['sideLeft'] as $key => $value)
		<p>{{$value}}</p>
	@endforeach

@endif