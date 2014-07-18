@section('title') Tambah Media @stop

@include('asmoyo::admin.media._upload')
@section('javascripts')
	@parent
	<script type="text/javascript">
		// generate slug
		$('#title').asmoyoHelper();
	</script>
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Tambah Media
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.media._menu')

		{{ Form::open(array(
            'method'    => 'POST',
            'url'       => route('admin.media.store'),
            'class'     => 'form-horizontal',
            'id'        => 'dropzone',
            'files'     => true
        )) }}

        	{{Form::hidden('type', 'internal')}}
        	
        	<div class="form-group">
				<label for="title" class="col-sm-3 control-label">
					Title
				</label>
				<div class="col-sm-9">
					{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'asmoyo-helper' => 'GenerateSlug', 'placeholder' => 'Title'))}}
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-3 control-label">
					Slug
				</label>
				<div class="col-sm-9">
					<div class="input-group">
						<div class="input-group-addon">
							{{route('admin.media.index')}}
						</div>
						{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
					</div>
				</div>
			</div>

        	<div class="form-group">
				<label for="description" class="col-sm-3 control-label">
					Description
				</label>
				<div class="col-sm-9">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description', 'rows'=>'4'))}}
				</div>
			</div>

        	<div class="form-group">
        		<label for="title" class="col-sm-3 control-label">
					Gunakan Watermark
				</label>
				<div class="col-sm-9">
		        	<div class="checkbox">
						<label>
							{{Form::checkbox('withWatermark', 1, null)}}
							Watermark
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="col-sm-3 control-label">
					Upload Gambar
				</label>
				<div class="col-sm-9">
		        	<a id="uploadBtn" class="btn btn-success">
		        		<i class="fa fa-picture-o"></i> Browse Images &amp; Save
		        	</a>
	        	</div>
        	</div>

        	<div id="uploadPreview" class="dropzone" style="min-height:100px;"></div>

        {{ Form::close() }}

	</div>
</div>