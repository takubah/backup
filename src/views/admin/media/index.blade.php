@section('title') Daftar Media @stop

<script type="text/javascript">
    
</script>

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Daftar Media
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.media._menu')

        <div class="alert alert-info">
            Jika ada gambar yang telah diperbarui tetapi tidak berubah.
            tekan ( <a class="btn btn-default btn-xs">CTRL</a> + <a class="btn btn-default btn-xs">F5</a> )
        </div>

		<div class="row">
		@if($medias['total'])
		@foreach($medias['items'] as $media)
			<div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <div style="background:url( {{getMedia($media['file'])}} ) center center; background-size: cover; height:200px;"> &nbsp; </div>
                    <div class="caption">
                        <div class="text-center">
                            <a href="{{ URL::route('admin.media.edit', $media['id']) }}" class="btn btn-primary">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            {{ Form::asmoyoLink(
                                ' Hapus',
                                'DELETE',
                                route('admin.media.destroy', $media['id']),
                                array(
                                    'class' => 'btn btn-danger',
                                    'icon'  => 'fa fa-trash-o',
                                    'data-placement' => 'right',
                                    'title'     => 'right'
                                ),
                                'Apakah anda yakin ?'
                            ) }}
                        </div>
                    </div>
                </div>
            </div>
		@endforeach
		@else
			<h4 class="text-center">Tidak ada data</h4>
		@endif
		</div>

		{{$medias->links()}}

	</div>
</div>