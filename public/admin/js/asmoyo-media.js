(function ( $ ) {

    var asmoyoMediaModalParam = {field:'', preview:''};

    $.fn.setAsmoyoMediaModal = function( field, preview )
    {
        return $( this ).click(function() {
            asmoyoMediaModalParam = {field: field, preview: preview};
            console.log(asmoyoMediaModalParam);
        });
    };

    $.fn.asmoyoMediaModal = function()
    {
        return $('.media_item').click(function() {

            var mediaSelected       = $(this).attr('data-image');
            var urlMediaSelected    = $(this).attr('data-image-url');

            $( asmoyoMediaModalParam.field ).val(mediaSelected);
            $( asmoyoMediaModalParam.preview ).css('background', 'url("'+ urlMediaSelected +'") center no-repeat');
        }); 
    };
 
}( jQuery ));