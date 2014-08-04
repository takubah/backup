<?php
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;


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
        $theme = $web['web_adminTemplate']['name'];
    } elseif($theme == 'public') {
        $theme = $web['web_publicTemplate']['name'];
    }
    return route('getAssets', $theme.'/'.$file);
}

function pseudoRead($str)
{
    return Pseudo::read($str);
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
        $theme = $web['web_adminTemplate']['name'];
    } elseif($theme == 'public') {
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

HTML::macro('select', function($value, $list=array(), $attr=array(), $attrChild=array()){
    
    $output = '<ul';
    if (is_array($attr)) {
        foreach ($attr as $key => $v) {
            $output .= ' '. $key .'="'.$v.'" ';
        }
    }
    $output .= '>';

    foreach ($list as $target => $text) {
        $output .= '<li>';
        $output .= '<a data-target="'.$target.'" data-value="'.$value.'" ';

        if ($attrChild) {
            foreach ($attrChild as $key => $v) {
                $output .= $key .'="'.$v.'" ';
            }
        }

        $output .= '>'. $text .'</a>';
        $output .= '</li>';
    }
    $output .= '</ul>';
    return $output;
});

Form::macro('asmoyoWidget', function($name, $type, $value=null, $i=null, $attr=array())
{
    $output = '';
    $id     = $name.'_'.$i;
    $name   = 'content['.$name.'][]';
    switch ($type) {
        case 'text':
            $prop   = array('id' => $id, 'class' => 'form-control');
            $attr   = array_merge($prop, $attr);
            $output .= Form::text($name, $value, $attr);
        break;

        case 'textarea':
            $prop   = array('id' => $id, 'class' => 'form-control', 'rows' => '3');
            $attr   = array_merge($prop, $attr);
            $output .= Form::textarea($name, $value, $attr);
        break;

        case 'media':
            $prop   = array('id' => $id, 'class' => 'form-control');
            $attr   = array_merge($prop, $attr);
            $output .= Form::text($name, $value, $attr);

            $id_preview = 'media_preview_'.$i;
            $output .= '<a id="'.$id_preview.'" class="thumbnail" style="margin:0px; height:300px; background:url(\''.$value.'\') center no-repeat; "> </a>';

            $id_caller  = 'media_caller_'.$i;
            $output .= '
                <a href="'.route('admin.media.ajaxIndex').'" id="'.$id_caller.'" class="btn btn-default medias" data-toggle="modal" data-target="#modalAjax" >
                    <i class="fa fa-picture-o"></i>
                    Select Media
                </a>
            ';
        break;
    
        default:
            return 'field type not found';
        break;
    }

    return $output;
});