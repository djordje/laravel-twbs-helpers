<?php namespace Djordje\LaravelTwbsHelpers\Facades;

use Illuminate\Support\Facades\Facade;

class TwbsNav extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'twbs.nav'; }
}