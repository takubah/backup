@section('title') Buat Halaman @stop

@section('stylesheets')
	@parent
	{{asmoyoAsset('plugin/froala_editor/css/froala_editor.min.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset('plugin/froala_editor/js/froala_editor.min.js', 'admin')}}

	<script>
		var froala_options = {
			imageUploadURL: "{{route('admin.media.storeFroala')}}",
			height: 300
		};

	    $(function() {
	        $('.froala_editor_inline').editable(froala_options);
	    });

	    $(function() {
	        $('.froala_editor').editable( jQuery.extend({inlineMode: false}, froala_options) );
	    });
	</script>
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Buat Halaman
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')

		{{Form::open(array('route' => 'admin.page.store', 'class' => 'form-horizontal'))}}

			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">
					Title
				</label>
				<div class="col-sm-10">
					{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'title'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">
					Slug
				</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							{{url()}}
						</div>
						{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="content" class="col-sm-2 control-label">
					Content
				</label>
				<div class="col-sm-10">
					{{Form::textarea('content', null, array('class' => 'form-control froala_editor', 'id' => 'content', 'placeholder' => 'content', 'style' => 'height:500px;'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="meta_title" class="col-sm-2 control-label">
					Meta Title
				</label>
				<div class="col-sm-10">
					{{Form::text('meta_title', null, array('class' => 'form-control', 'id' => 'meta_title', 'placeholder' => 'Meta title'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="meta_keyword" class="col-sm-2 control-label">
					Meta Keyword
				</label>
				<div class="col-sm-10">
					{{Form::textarea('meta_keyword', null, array('class' => 'form-control', 'id' => 'meta_keyword', 'rows' => 3, 'placeholder' => 'Meta keyword'))}}
				</div>
			</div>
			
			<div class="form-group">
				<label for="meta_description" class="col-sm-2 control-label">
					Meta Description
				</label>
				<div class="col-sm-10">
					{{Form::textarea('meta_description', null, array('class' => 'form-control', 'id' => 'meta_description', 'rows' => 3, 'placeholder' => 'Meta description'))}}
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