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

	public function myMorphTo($related = null, $name = null, $type = null, $id = null)
	{
		if (is_null($name))
		{
			list(, $caller) = debug_backtrace(false);

			$name = snake_case($caller['function']);
		}

		list($type, $id) = $this->getMorphs($name, $type, $id);

		if (is_null($class = $this->$type))
		{
			return new MorphTo(
				$this->newQuery(), $this, $id, null, $type, $name
			);
		}

		else
		{
			$instance = ($related) ? new $related : new $class;

			return new MorphTo(
				with($instance)->newQuery(), $this, $id, $instance->getKeyName(), $type, $name
			);
		}
	}

}