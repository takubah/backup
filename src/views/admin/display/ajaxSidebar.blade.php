{{Form::open(array('method' => 'POST', 'route' => array('admin.display.update', $position), 'class' => 'form-horizontal', 'onsubmit' => 'widgetSubmit(\''.$position.'\', this)'))}}
	{{Form::hidden('position', $position)}}
<ul class="widget-sortable nav">
	@if($sidebar)
	<?php $i = 1; ?>
	@foreach($sidebar as $side)
		<?php $read = pseudoRead($side['content']); ?>
		<li>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						{{ucfirst($read['object'])}}
						<span class="pull-right btn btn-default btn-xs handle">
							<i class="fa fa-arrows"></i>
						</span>
						<span class="pull-right btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href=".panel_{{$position}}_{{$i}}">
							<i class="fa fa-arrow-down"></i>
						</span>
					</h3>
				</div>
				<div class="panel_{{$position}}_{{$i}} panel-collapse collapse">
					<div class="panel-body">
						<p>
							<label style="font-size:12px;">Title</label>
							{{Form::text('title[]', $side['title'], array('class' => 'form-control input-sm'))}}
						</p>
						<p>
							<label style="font-size:12px;">Type</label>
							{{Form::select('type[]', $pseudoTypeList, $read['type'], array('class' => 'form-control input-sm'))}}
						</p>
						<p>
							<label style="font-size:12px;">Sortir</label>
							{{Form::select('sortir[]', $pseudoSortirList, $read['sortir'], array('class' => 'form-control input-sm'))}}
						</p>
					</div>
				</div>
			</div>
		</li>
		<?php $i++; ?>
	@endforeach
	@endif
</ul>
<div class="form-group">
	<div class="col-sm-12 text-center">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-check"></i>
			Simpan
		</button>
	</div>
</div>
{{Form::close()}}

<script type="text/javascript">
	// handle sortable
	$( ".widget-sortable" ).sortable({
		revert: true,
		handle: ".handle",
		cursor: "move",
		receive: function(event, ui) {
			// $(this).html('test');
		}
	});

	// handle form submit
	function widgetSubmit(position, that)
	{
		$.ajax({
			type: "POST",
			url: $(that).attr('action'),
			data: $(that).serialize()
		})
		.success(function( msg )
		{					
			return msg;
		});
		event.preventDefault();
	}
</script>