<?php

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

function getMedia($file, $size='medium')
{
    return route('getMedia', $size .'/'. $file);
}

function getAssetUrl($file, $theme='admin')
{
    $web    = app('asmoyo.web');
    if($theme == 'admin')
    {
        $theme = $web['web_adminTemplate'];
    } elseif($theme == 'public') {
        $theme = $web['web_publicTemplate'];
    }
    return route('getAssets', $theme.'/'.$file);
}

function asmoyoAsset($file, $theme='admin')
{
    return HTML::asmoyoAsset($file, $theme);
}

HTML::macro('asmoyoAsset', function($file, $theme='admin')
{
	$web 	= app('asmoyo.web');
    if($theme == 'admin')
    {
        $theme = $web['web_adminTemplate'];
    } elseif($theme == 'public') {
        $theme = $web['web_publicTemplate'];
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

        case 'url':
            return $url;
        break;
        
        default:
            // generate url
            return $url;
        break;
    }
});

// Form Link
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