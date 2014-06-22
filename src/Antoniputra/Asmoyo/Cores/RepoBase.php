<?php namespace Antoniputra\Asmoyo\Cores;

use Lang, Validator;

abstract class RepoBase
{
	public $model;

	public $rules = array();

	public function __construct(null $model)
	{
		$this->model = $model;
	}

	public function doValidation($input, $custom_rules=array())
	{
		$rules = $this->prepareValidation( $input, array_merge($this->model->rules, $custom_rules) );

		$messages   = Lang::get('validation.custom');
        $v          = Validator::make($input, $rules, $messages);
        
         // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->messages()->all();
            return false;
        }

        return true;
	}

	private function prepareValidation($input, $rules)
    {
        $preparedRules = array();

        foreach ($rules as $key => $rule)
        {
            if (false !== strpos($rule, "<id>"))
            {
                $rule = str_replace("<id>", $input['id'], $rule);
            }
            elseif (false !== strpos($rule, "<url>"))
            {
                $rule = str_replace("<url>", $input['url'], $rule);
            }

            $preparedRules[$key] = $rule;
        }

        return $preparedRules;
    }

}