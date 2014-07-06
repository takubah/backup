@section('title') Buat Posting @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Buat Posting
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.post._menu')

		{{Form::open(array('route' => 'admin.post.store', 'class' => 'form-horizontal'))}}

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
					{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="category" class="col-sm-2 control-label">
					Category
				</label>
				<div class="col-sm-10">
					{{Form::text('category', null, array('class' => 'form-control', 'id' => 'category', 'placeholder' => 'category'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">
					Description
				</label>
				<div class="col-sm-10">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'rows' => '5', 'placeholder' => 'description'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="body" class="col-sm-2 control-label">
					Body
				</label>
				<div class="col-sm-10">
					{{Form::textarea('body', null, array('class' => 'form-control', 'id' => 'body', 'placeholder' => 'body'))}}
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