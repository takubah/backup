@section('title') Edit Kategori {{$category['title']}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Edit Kategori
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.category._menu')

		{{Form::model($category, array('route' => 'admin.category.store', 'class' => 'form-horizontal'))}}

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
				<label for="description" class="col-sm-2 control-label">
					Description
				</label>
				<div class="col-sm-10">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'rows' => '4', 'placeholder' => 'description'))}}
				</div>
			</div>
			
			<hr>
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