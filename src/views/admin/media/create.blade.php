@section('title') Tambah Media @stop

@section('stylesheets')
	@parent
	{{asmoyoAsset('plugin/dropzone/css/dropzone.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset('plugin/dropzone/dropzone.min.js', 'admin')}}
	<script type="text/javascript">
        $(function() {
            Dropzone.autoDiscover = false;
            
            var myDropzone = new Dropzone("#dropzone", {
                // config here....
                // previewsContainer: "#previews", 
                // clickable: "#clickable",
                // autoProcessQueue: false,

                init: function() {
                    this.on('addedfile', function(file) {
                        // events where file has been added

                        // add confirmation
                        if( ! confirm('anda yakin mengupload file ini ?') )
                        {
                            this.removeFile(file);
                            return;
                        }
                    });

                    this.on("complete", function(file) {
                        // window.location = "./Dashboard/Report/";
                    });
                }
            });

            // Events when file has been added at preview element
            // myDropzone.on("addedfile", function(file) {
            //     alert("Added file.");
            // });

            // myDropzone.on("complete", function(file) {
            //     window.location = "./Dashboard/Report/";
            // });
        });
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
            'class'     => 'form-horizontal dropzone',
            'id'        => 'dropzone',
            'files'     => true
        )) }}

        	{{Form::hidden('type', 'internal')}}

        {{ Form::close() }}

	</div>
</div>