<?php
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

/**
* Global Function
*/

// get mime type (used for response content type)
function getMime($ext, $default='text/html')
{
    $mimes = array(
        'css'   => 'text/css',
        'js'    => 'text/javascript',
        'jpg'   => 'image/jpg',
        'jpeg'  => 'image/jpeg',
        'png'   => 'image/png',
        'gif'   => 'image/gif',
        'woff'  => 'application/x-font-woff',
    );

    if ( ! array_key_exists($ext, $mimes)) return $default;

    return $mimes[$ext];
}

// shortcut function for get media file
function getMedia($file, $size='medium')
{
    return route('getMedia', $size .'/'. $file);
}

// shortcut function for generate asset.
// with defined relative path given template name
function asmoyoAsset($file, $theme='admin')
{
    return HTML::asmoyoAsset($file, $theme);
}

/**
* End Global Function
*/


/**
* Macro
*/

// generate asset to relative template
HTML::macro('asmoyoAsset', function($file, $theme='admin')
{
	$web 	= app('asmoyo.web');
    // is admin
    if($theme == 'admin')
    {
        $theme = $web['web_adminTemplate']['name'];
    }
    // is public
    elseif($theme == 'public')
    {
        $theme = $web['web_publicTemplate']['name'];
    }

	$url 	= route('getAssets', $theme.'/'.$file);

    // get file extension
    switch ( substr(strrchr($file, '.'), 1) ) {
        case 'css':
            return HTML::style($url);
        break;
        
        case 'js':
            return HTML::script($url);
        break;
        
        default:
            // generate url
            return $url;
        break;
    }
});

// generate link from form so can custom method
Form::macro('asmoyoLink', function($text, $method, $action, $attr = array(), $confirm_message=null)
{
    // attribute for form
    $formAttr = array('method' => $method, 'url' => $action, 'style' => 'display:inline-block;');

    // append onSubmit
    if($confirm_message) $formAttr = array_merge( $formAttr, array('onsubmit' => 'return confirm("'.$confirm_message.'");') );

    $output = Form::open($formAttr);

    $output .= '<button type="submit"';
        // give attributes
        if (!empty($attr) AND is_array($attr)) {
            foreach ($attr as $key => $value) {
                if ($key != 'icon') {
                    $output .= ' '.$key.'="'. $value .'" ';
                }
            }
        }
    $output .= '>';

    if(isset($attr['icon'])) {
        $output .= '<i class="'.$attr['icon'].'"></i> ';
    }
    
    $output .= $text .'</button>';

    $output .= Form::close();
    
    return $output;
});

/**
* End Macro
*/