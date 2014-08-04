<ul class="widget-sortable list-group">
	@if($sidebar)
	@foreach($sidebar as $side)
		<li class="list-group-item">
			{{Form::text('title', $side['title'], array('class' => 'form-control'))}}
			<p class="list-group-item-text">
				<?php $read = pseudoRead($side['content']); ?>
				@if( is_array($read) )
					<ul class="nav">
						<li>object : {{ $read['object'] }}</li>
						<li>type : {{ $read['type'] }}</li>
						<li>sortir : {{ $read['sortir'] }}</li>
					</ul>
				@else
					{{ $side['content'] }}
				@endif
			</p>
		</li>
	@endforeach
		<li>testing prend 1</li>
		<li>testing prend 2</li>
	@endif
</ul>

<script type="text/javascript">
	$( ".widget-sortable" ).sortable({
		revert: true,
		receive: function(event, ui) {
			// $(this).html('test');
		}
	});
</script>