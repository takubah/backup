<?php namespace Antoniputra\Asmoyo\Cores;

use Lang, Input, Validator, Config, Cache;

abstract class RepoBase
{
	public $model;

    public $webOption;

	public $cacheObjTag;

	public function __construct($model=null)
	{
		$this->model      = $model;
        $this->webOption  = app('asmoyo.web');
	}

    /**
    * manage cache tag for all repo
    * @param array
    * @return Cache Object
    */
    protected function repoCacheTag($cacheObjTag=array())
    {
        $cacheTags = array(Config::get('asmoyo::cache.base_name'));

        if( !is_array($cacheObjTag) ) {
            $cacheObjTag = array($cacheObjTag);
        }

        $cacheTags = array_merge($cacheTags, $cacheObjTag);

        return Cache::tags( $cacheTags );
    }

    protected function cacheStore($key, $value)
    {
        $cacheTime = Config::get('asmoyo::cache.time');
        
        if( is_integer($cacheTime) )
        {
            $this->cacheObjTag->put($key, $value, $cacheTime);
        }
        else
        {
            $this->cacheObjTag->forever($key, $value);
        }

        return $value;
    }

    protected function cacheGet($key)
    {
        if( $this->cacheObjTag->has($key) )
        {
            return $this->cacheObjTag->get($key);
        }

        return false;
    }

    protected function cacheForget($key)
    {
        if( $this->cacheObjTag->has($key) )
        {
            return $this->cacheObjTag->forget($key);
        }
    }

	protected function repoValidation($input, $custom_rules=array())
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
            elseif (false !== strpos($rule, "<slug>"))
            {
                $rule = str_replace("<slug>", $input['slug'], $rule);
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

        $data = $data->limit( $this->repoLimit() );

        return $data;
    }

    /**
    * Set global limit data for all object
    * @param $limit integer|numeric
    */
    protected function repoLimit($limit=null)
    {
        $limit = Input::get('limit', $limit) ?: $this->webOption['web_itemPerPage'];

        return is_numeric($limit) ? $limit : 10;
    }

}