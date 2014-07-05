<?php

HTML::macro('asmoyoTheme', function($file, $type='css', $admin = false)
{
	$web 	= app('asmoyo.web');
	$theme 	= ($admin) ? $web['web_adminTemplate'] : $web['web_publicTemplate'];
	$url 	= route('assets.theme.get', $theme) .'/'. $file;
	return ($type == 'css') ? HTML::style($url) : HTML::script($url);
});

// Form Link
Form::macro('asmoyoLink', function($text, $method, $action, $attr = array(), $is_confirm=false)
{
    // attribute for form
    $formAttr = array('method' => $method, 'url' => $action, 'style' => 'display:inline-block;');

    // append onSubmit
    if($is_confirm) $formAttr = array_merge( $formAttr, array('onsubmit' => 'return confirm("Are you sure ?");') );

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