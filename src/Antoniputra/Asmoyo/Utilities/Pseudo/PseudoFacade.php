<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo;

use Illuminate\Support\Facades\Facade;

class PseudoFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'asmoyo.pseudo'; }

}