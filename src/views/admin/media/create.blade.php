@section('title') Tambah Media @stop

@include('asmoyo::admin.media._upload')

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
            'class'     => 'form-horizontal dropzone',
            'id'        => 'dropzone',
            'files'     => true
        )) }}

        	{{Form::hidden('type', 'internal')}}

        {{ Form::close() }}

	</div>
</div>