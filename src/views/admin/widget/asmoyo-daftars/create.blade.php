@section('title') Tambah Widget Grup @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Tambah Widget Grup
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{Form::open(array('url' => route('admin.widget.group.store', array($widget['slug'])), 'method' => 'POST', 'class' => 'form-horizontal'))}}

			{{Form::hidden('widget_id', $widget['id'])}}

			<div class="form-group">
				<label class="col-md-2 control-label">
					Title
				</label>
				<div class="col-md-9">
					{{Form::text('title', null, array('class' => 'form-control'))}}
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">
					Type
				</label>
				<div class="col-md-9">
					{{Form::select('type', $typeList, null, array('class' => 'form-control'))}}
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">
					Description
				</label>
				<div class="col-md-9">
					{{Form::textarea('description', null, array('class' => 'form-control', 'rows' => 4))}}
				</div>
			</div>
			
			<hr>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>