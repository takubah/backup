(function ( $ ) {

	$.fn.asmoyoHelper = function(options)
    {
        var settings 	= $.extend({
            field: $(this),
            fieldTarget: $('#slug'),
        }, options ),
        	funcName 	= 'asmoyo'+settings.field.attr('asmoyo-helper'),
    	 	runFunction = window[funcName];

	 	if(typeof runFunction !== 'function') {
	 		return console.log('a helper : '+ funcName +' is not available');
	 	}
	 	return runFunction(settings);
    };

}( jQuery ));

// Generate Slug
function asmoyoGenerateSlug(options)
{
	var title  	= options.field,
		slug 	= options.fieldTarget;

	title.keyup(function(){
		var defValue = $(this).val();
		var value = convertToSlug(defValue); 
		slug.val(value);
	});

	slug.keydown(function(e){
		if (e.which === 32)
			return false;
	});

	slug.change(function(){
		var defValue = $(this).val();
		var value = convertToSlug(defValue); 
		slug.val(value);
	});
}

function convertToSlug(Text)
{
    return Text.toLowerCase().replace("/+/g", '').replace(/\s+/g, '-').replace(/[^a-z0-9-]/gi, '');
}
// End Generate Slug