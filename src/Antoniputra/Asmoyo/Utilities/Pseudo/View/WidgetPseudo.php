<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

class WidgetPseudo extends \Pseudo
{
	
	public function translate($prop)
	{
		echo "<pre>";
		print_r($prop);
		exit('here');
		return ' ini adalah translate post';
	}

}