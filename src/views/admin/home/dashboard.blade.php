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

	</div>
	<div class="col-md-6">

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-comments"></i>
				Tanggapan Terakhir
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:comment type=list sortir=title-descending>}' }}
				{{ '{<asmoyo:category type=list sortir=title-descending>}' }}
			</div>
		</div>

	</div>
</div>

@section('sideRight')
	{{--@include('asmoyo::admin.partials.officialInfo')--}}
@stop