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
                previewsContainer: "#uploadPreview", 
                clickable: "#uploadBtn",

                maxFiles: @if( isset($media['id']) ) 1 @endif,
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
                        $('#title').val('');
                        $('#description').val('');

                        @if( isset($media['id']) )
                            window.location = "{{route('admin.media.index')}}";
                        @endif
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