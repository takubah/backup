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
		$this->registerObject();
	}

	public function registerObject()
	{
		$app = $this->app;

		// Option Object
		$app->bind('asmoyo.option', function()
		{
			return new \Antoniputra\Asmoyo\Options\Option;
			// return new \Antoniputra\Asmoyo\Options\OptionRepo(
			// 	new \Antoniputra\Asmoyo\Options\Option
			// );
		});

		// get website current option
		$app->bindShared('asmoyo.web', function()
		{
			return \Antoniputra\Asmoyo\Options\Option::all();
		});

		// Media Object
		$app->bind('asmoyo.media', function()
		{
			return new \Antoniputra\Asmoyo\Medias\Media;
		});

		// User Object
		$app->bind('asmoyo.user', function()
		{
			return new \Antoniputra\Asmoyo\Users\User;
		});

		// Category Object
		$app->bind('asmoyo.category', function()
		{
			return new \Antoniputra\Asmoyo\Categories\Category;
		});

		// Page Object
		$app->bind('asmoyo.page', function()
		{
			return new \Antoniputra\Asmoyo\Pages\Page;
		});

		// Post Object
		$app->bind('asmoyo.post', function()
		{
			return new \Antoniputra\Asmoyo\Posts\Post;
		});


	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('asmoyo.option');
	}

}
