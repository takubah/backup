@section('title') Edit Media : {{$media['title']}} @stop

@include('asmoyo::admin.media._upload')

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Edit Media : {{$media['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.media._menu')

		{{ Form::model($media, array(
            'method'    => 'PUT',
            'url'       => route('admin.media.update', $media['id']),
            'class'     => 'form-horizontal',
            'id'        => 'dropzone',
            'files'     => true
        )) }}

        	{{Form::hidden('type', null)}}
        	{{Form::hidden('fileName', $media['file'])}}
        	
        	<div class="form-group">
				<label class="col-sm-3 control-label">
					Gambar
				</label>
				<div class="col-sm-9">
					<a class="thumbnail">
						<img src="{{getMedia($media['file'])}}">
					</a>
				</div>
			</div>

        	<div class="form-group">
				<label for="title" class="col-sm-3 control-label">
					Title
				</label>
				<div class="col-sm-9">
					{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title'))}}
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
		        		<i class="fa fa-picture-o"></i> Change Image &amp; Save Change
		        	</a>
		        	&nbsp; - &nbsp;
		        	<button type="submit" class="btn btn-primary">
						Save Changes &raquo;
					</button>
	        	</div>
        	</div>

        	<div id="uploadPreview" class="dropzone" style="min-height:100px;"></div>

        {{ Form::close() }}

	</div>
</div>