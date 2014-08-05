@if($sidebar)
	{{Form::open(array('method' => 'POST', 'route' => array('admin.display.ajaxUpdate', $position), 'class' => 'form-horizontal', 'onsubmit' => 'widgetSubmit(\''.$position.'\', this)', 'id' => 'form_'.$position))}}
		{{Form::hidden('position', $position)}}
	<ul class="widget-sortable nav">
		<?php $i = 1; ?>
		@foreach($sidebar as $key => $side)
			<?php $read = pseudoRead($side['content']); ?>
			<li>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="position:relative;">
							{{ (isset($read['widget-name']) AND $read['widget-name']) ?$read['widget-name'] : ucfirst($read['object']) }} <br>
							<small style="font-size:12px;">
								<b>{{$side['title']}}</b> - {{$read['type']}} - {{$read['sortir']}}
							</small>
							<div style="position:absolute; top:3px; right:0px;">
								<span class="btn btn-default btn-sm handle">
									<i class="fa fa-arrows"></i>
								</span>
								<span class="btn btn-default btn-sm" data-toggle="collapse" data-parent="#accordion" href=".panel_{{$position}}_{{$i}}">
									<i class="fa fa-arrow-down"></i>
								</span>
							</div>
						</h3>
					</div>
					<div class="panel_{{$position}}_{{$i}} panel-collapse collapse">
						<div class="panel-body">
							{{Form::hidden('object[]', $read['object'])}}

							@if( isset($read['widget-name']) )
								{{Form::hidden('widget_name[]', $read['widget-name'])}}
							@else
								{{Form::hidden('widget_name[]', null)}}
							@endif

							@if( isset($side['title']) )
								<p>
									<label style="font-size:12px;">Title</label>
									{{Form::text('title[]', $side['title'], array('class' => 'form-control input-sm'))}}
								</p>
							@endif

							@if( isset($read['type']) )
								<p>
									<label style="font-size:12px;">Type</label>
									{{Form::select('type[]', $pseudoTypeList, $read['type'], array('class' => 'form-control input-sm'))}}
								</p>
							@endif

							@if( isset($read['sortir']) )
								<p>
									<label style="font-size:12px;">Sortir</label>
									{{Form::select('sortir[]', $pseudoSortirList, $read['sortir'], array('class' => 'form-control input-sm'))}}
								</p>
							@endif

							<!-- btn remove -->
							<div class="text-right">
								<a class="btn btn-danger btn-sm" data-key="{{$key}}" onclick="widgetRemove('{{$position}}', this)">Hapus</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<?php $i++; ?>
		@endforeach
	</ul>
	<div class="form-group">
		<div class="col-sm-12 text-center">
			<button type="submit" class="btn btn-primary btn-sm">
				<i class="fa fa-check"></i>
				Simpan
			</button>
		</div>
	</div>
	{{Form::close()}}
@else
	<h4 class="text-center">Tidak ada widget</h4>
@endif

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

	// handle widget remove
	function widgetRemove(position, that)
	{
		if ( ! confirm('anda yakin ?')) { return false; };
		if(position == 'right') {
			var urlDelete = "{{route('admin.display.ajaxSidebarRemove', 'right')}}",
				url 	= "{{route('admin.display.ajaxSidebar', 'right')}}",
				target 	= "#sideRight";
		} else {
			var urlDelete = "{{route('admin.display.ajaxSidebarRemove', 'left')}}",
				url 	= "{{route('admin.display.ajaxSidebar', 'left')}}",
				target 	= "#sideLeft";
		}

		// delete process
		$( target ).html('loading...');
		$.ajax({
			type: "POST",
			url: urlDelete,
			data: { key: $(that).attr('data-key') }
		})
		.success(function( msg )
		{
			if (msg) {
				$.get(url, function(data,status)
				{
					$( target ).html(data);
				});
			} else {
				alert('error');
			}
		});
		event.preventDefault();
	}

	// handle widget save
	function widgetSubmit(position, form)
	{
		if(position == 'right') {
			var url 	= "{{route('admin.display.ajaxSidebar', 'right')}}",
				target 	= "#sideRight";
		} else {
			var url 	= "{{route('admin.display.ajaxSidebar', 'left')}}",
				target 	= "#sideLeft";
		}

		// update process
		$( target ).html('loading...');
		$.ajax({
			type: "POST",
			url: $(form).attr('action'),
			data: $(form).serialize()
		})
		.success(function( msg )
		{
			if (msg) {
				$.get(url, function(data,status)
				{
					$( target ).html(data);
				});
			} else {
				alert('error');
			}
		});
		event.preventDefault();
	}
</script>