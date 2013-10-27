<?php namespace Djordje\LaravelTwbsHelpers;

use Djordje\LaravelTwbsHelpers\Html\Navbar\NavBuilder;
use Illuminate\Support\ServiceProvider;

class LaravelTwbsHelpersServiceProvider extends ServiceProvider {

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
		$this->package('djordje/laravel-twbs-helpers');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['twbs.nav'] = $this->app->share(function($app)
		{
			return new NavBuilder();
		});
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