<?php namespace Antoniputra\Asmoyo;

use Illuminate\Support\ServiceProvider;
use Config, Cache;

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
		if ( Config::get('asmoyo::profiler') )
		{
			$this->app->register('Profiler\ProfilerServiceProvider');
		}

		// set Auth model
		Config::set('auth.model', 'Antoniputra\Asmoyo\User\User');

		include __DIR__ . '/../../filters.php';
		include __DIR__ . '/../../routes.php';
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

	protected function registerObject()
	{
		$app = $this->app;

		// get website current option
		$this->app->bindShared('asmoyo.resources', function()
		{
			return array('option', 'media', 'user', 'category', 'page', 'post', 'widget');
		});

		// Option Object
		$app->bind('Antoniputra\Asmoyo\Options\OptionInterface', function($app)
		{
			return new \Antoniputra\Asmoyo\Options\OptionRepo(
				new \Antoniputra\Asmoyo\Options\Option
			);
		});

		// get website current option
		$this->app->bindShared('asmoyo.web', function($app)
		{
			return $app->make('Antoniputra\Asmoyo\Options\OptionInterface')->get();
		});

		// Media Object
		$app->bind('Antoniputra\Asmoyo\Medias\MediaInterface', function()
		{
			return new \Antoniputra\Asmoyo\Medias\MediaRepo(
				new \Antoniputra\Asmoyo\Medias\Media
			);
		});

		// User Object
		$app->bind('Antoniputra\Asmoyo\Users\UserInterface', function()
		{
			return new \Antoniputra\Asmoyo\Users\UserRepo(
				new \Antoniputra\Asmoyo\Users\User
			);
		});

		// Category Object
		$app->bind('Antoniputra\Asmoyo\Categories\CategoryInterface', function()
		{
			return new \Antoniputra\Asmoyo\Categories\CategoryRepo(
				new \Antoniputra\Asmoyo\Categories\Category
			);
		});

		// Page Object
		$app->bind('Antoniputra\Asmoyo\Pages\PageInterface', function()
		{
			return new \Antoniputra\Asmoyo\Pages\PageRepo(
				new \Antoniputra\Asmoyo\Pages\Page
			);
		});

		// Post Object
		$app->bind('Antoniputra\Asmoyo\Posts\PostInterface', function()
		{
			return new \Antoniputra\Asmoyo\Posts\PostRepo(
				new \Antoniputra\Asmoyo\Posts\Post
			);
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
