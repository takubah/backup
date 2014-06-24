<?php namespace Antoniputra\Asmoyo\Cores;

use Lang, Input, Validator;

abstract class RepoBase
{
	public $model;

    public $webOption;

	public $rules = array();

    public $repoLimit;

	public function __construct($model=null)
	{
		$this->model      = $model;
        $this->webOption  = app('asmoyo.web');
        $this->repoLimit  = Input::get('limit') ?: $this->webOption['web_itemPerPage'];
	}

	public function repoValidation($input, $custom_rules=array())
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


    protected function prepareData()
    {
        $data = $this->model;

        if( $sortir = Input::get('sortir') )
        {
            switch ( $sortir ) {
                case 'new':
                    $data = $data->orderBy('created', 'desc');
                break;
                
                case 'latest-updated':
                    $data = $data->orderBy('updated', 'desc');
                break;

                case 'title-ascending':
                    $data = $data->orderBy('title', 'asc');
                break;

                case 'title-descending':
                    $data = $data->orderBy('title', 'desc');
                break;

                case 'popular':
                    $data = $data->orderBy('title', 'desc');
                break;
                
                default:
                    // default by new
                    $data = $data->orderBy('created', 'desc');
                break;
            }
        }

        $data = $data->limit( $this->repoLimit );

        return $data;
    }

}