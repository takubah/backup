<?php namespace Antoniputra\Asmoyo\Utilities\Cache;

use Cache, Config;

class ModelObserver {

    protected function clearCacheTags($tags)
    {
        $tags = Config::get('asmoyo::cache.base_name').'.'.$tags;
        Cache::tags($tags)->flush();
    }

    public function saved($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    public function updated($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    public function deleted($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    public function restored($model)
    {
        $this->clearCacheTags($model->getTable());
    }

}