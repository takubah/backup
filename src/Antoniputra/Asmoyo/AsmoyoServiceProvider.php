<?php namespace Antoniputra\Asmoyo;

use Illuminate\Support\ServiceProvider;

class AsmoyoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('antoniputra/asmoyo');

		// register profiler when debug is true
		if ( \Config::get('asmoyo::profiler') )
		{
			$this->app->register('Profiler\ProfilerServiceProvider');
		}

		// set Auth model
		// \Config::set('auth.model', 'Antoniputra\Asmoyo\User\User');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
