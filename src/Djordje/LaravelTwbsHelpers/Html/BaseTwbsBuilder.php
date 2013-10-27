<?php namespace Djordje\LaravelTwbsHelpers\Html;

use Illuminate\Http\Request;

abstract class BaseTwbsBuilder {

	/**
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Check if passed link is currently active link
	 *
	 * @param string $link
	 * @return bool
	 */
	protected function isActiveLink($link)
	{
		$requestUrl = $this->request->url();

		return ($link === $requestUrl || rtrim($link, '/') === $requestUrl);
	}

}