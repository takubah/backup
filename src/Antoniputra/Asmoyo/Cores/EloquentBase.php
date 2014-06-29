<?php namespace Antoniputra\Asmoyo\Cores;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class EloquentBase extends \Eloquent
{
	
	public function setFillable($fillable=array())
	{
		$this->fillable = $fillable;
	}

	public function getFillable($fillable=array())
	{
		return $this->fillable;
	}

}