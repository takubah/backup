<div class="row">
	<div class="col-md-6">
		
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				Postingan Terakhir
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:post type=list sortir=latest-updated>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				List Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=list sortir=title-ascending>}' }}
			</div>
		</div>

	</div>
	<div class="col-md-6">

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-comments"></i>
				Grid Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=grid sortir=title-descending imageSize=80px>}' }}
			</div>
		</div>

	</div>
</div>

@section('sideRight')
	{{--@include('asmoyo::admin.partials.officialInfo')--}}
@stop