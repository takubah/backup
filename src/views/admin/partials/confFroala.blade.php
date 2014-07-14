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