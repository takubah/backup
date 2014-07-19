@section('stylesheets')
	@parent
	{{asmoyoAsset('plugin/froala_editor/css/froala_editor.min.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset('plugin/froala_editor/js/froala_editor.min.js', 'admin')}}

	<script>		
		var froala_defaults = {
			imageUploadURL: "{{route('admin.media.storeFroala')}}",
			imagesLoadURL: "{{route('admin.media.getForFroala')}}",
			height: 400,
			inlineMode: false
		};

	    $(function() {
	        $('.froala_editor').editable( jQuery.extend( froala_defaults, {} ) );
	        $('.froala_editor_inline').editable( jQuery.extend(froala_defaults, {inlineMode:true}) );
	    });
	</script>
@stop