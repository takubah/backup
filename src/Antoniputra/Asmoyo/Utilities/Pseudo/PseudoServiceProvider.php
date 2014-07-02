<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo;

use Illuminate\Support\ServiceProvider;
use Config, Cache;

class PseudoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['asmoyo.pseudo'] = $this->app->share(function($app)
        {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver 	= $app['view.engine.resolver'];

            $finder		= $app['view.finder'];

            $pseudo 	= new Pseudo($resolver, $finder, $app['events']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $pseudo->setContainer($app);

            $pseudo->share('app', $app);

            return $pseudo;
        });
	}

}