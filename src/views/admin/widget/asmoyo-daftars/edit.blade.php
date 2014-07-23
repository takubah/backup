@section('title') Edit Widget Grup {{$group['title']}} - Widget {{$widget['title']}} @stop

@section('stylesheets')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.js', 'admin')}}
	<script type="text/javascript">
		// sortable
		var group = $("#widgetSortir").sortable({
			group: 'serialization',
			handle: '#btn-move',
			onDrop: function (item, container, _super)
			{
				_super(item, container);
			}
		});

		// remove element
		$(".removeItem").click(function() {
			if(confirm('anda yakin ?'))
			{
				var item = $(this).attr('data-remove');
				$( item ).remove();
			}
		});
	</script>
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Edit Widget Grup {{$group['title']}} - Widget {{$widget['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{Form::open(array('url' => route('admin.widget.group.update', array($widget['slug'], $group['slug'])), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			{{Form::hidden('id', $group['id'])}}
			{{Form::hidden('widget_id', $group['widget_id'])}}

			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<h4 class="panel-title">
								<i class="fa fa-pencil"></i>
								Edit Identitas Grup
							</h4>
						</a>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-2 control-label">
									Title
								</label>
								<div class="col-md-9">
									{{Form::text('title', $group['title'], array('class' => 'form-control'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">
									Type
								</label>
								<div class="col-md-9">
									{{Form::select('type', $typeList, $group['type'], array('class' => 'form-control'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">
									Description
								</label>
								<div class="col-md-9">
									{{Form::textarea('description', $group['description'], array('class' => 'form-control', 'rows' => 4))}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<ol id="widgetSortir" class="sortable asmoyo-widget-sortir">
			@if($group['content'])
			<?php $i = 1; ?>
			@foreach($group['content'] as $w)
				{{Form::hidden('content[icon][]', $w['icon'], array('class' => 'form-control'))}}
				<li id="item_{{$i}}" style="position:relative;">
					<i id="btn-move" class="fa fa-arrows" style="cursor:move;"></i>

					<a data-remove="#item_{{$i}}" class="btn btn-default removeItem" style="position:absolute; right:0px; top:0px; z-index:9;">
						Remove
					</a>

					<div class="form-group">
						<label class="col-md-2 control-label">
							Title
						</label>
						<div class="col-md-9">
							{{Form::text('content[title][]', $w['title'], array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							Link
						</label>
						<div class="col-md-9">
							{{Form::text('content[link][]', $w['link'], array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							Description
						</label>
						<div class="col-md-9">
							{{Form::textarea('content[description][]', $w['description'], array('class' => 'form-control', 'rows' => '3'))}}
						</div>
					</div>
					<hr style="border-color:#999;">
				</li>
				<?php $i++; ?>
			@endforeach
			@endif
			</ol>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan Perubahan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>