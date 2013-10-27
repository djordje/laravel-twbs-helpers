<?php namespace Djordje\LaravelTwbsHelpers\tests\Html\Navbar;

use Djordje\LaravelTwbsHelpers\Html\Navbar\NavBuilder;
use Illuminate\Support\Facades\Request;
use Mockery;

class NavBuilderTest extends \PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		Mockery::close();
	}

	public function testBuild()
	{
		$nav = new NavBuilder();

		$menu = array(
			'Home' => '/',
			'About' => '/about',
			'Service' => '/service'
		);
		$expected = '<li class="active"><a href="/">Home</a></li>';
		$expected .= '<li><a href="/about">About</a></li>';
		$expected .= '<li><a href="/service">Service</a></li>';

		Request::shouldReceive('url')->once()->andReturn('/');

		$this->assertEquals($expected, $nav->build($menu));

		$menu = array(
			'Home' => '/',
			'About' => '/about',
			'Service' => '/service'
		);
		$expected = '<li><a href="/">Home</a></li>';
		$expected .= '<li><a href="/about">About</a></li>';
		$expected .= '<li><a href="/service">Service</a></li>';

		Request::shouldReceive('url')->once()->andReturn('/test');

		$this->assertEquals($expected, $nav->build($menu));
	}

	public function testBuildDropdown()
	{
		$nav = new NavBuilder();

		$menu = array(
			'Home' => '/',
			'About' => '/about',
			'Service' => '/service'
		);

		$expected = '<li class="dropdown">';
		$expected .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Test <b class="caret"></b></a>';
		$expected .= '<ul class="dropdown-menu">';
		$expected .= '<li><a href="/">Home</a></li>';
		$expected .= '<li><a href="/about">About</a></li>';
		$expected .= '<li><a href="/service">Service</a></li>';
		$expected .= '</ul></li>';

		Request::shouldReceive('url')->once()->andReturn('/user/1');

		$this->assertEquals($expected, $nav->buildDropdown($menu, 'Dropdown Test'));

		$menu = array(
			'Home' => '/',
			'About' => '/about',
			'-divider-',
			'Service' => '/service'
		);

		$expected = '<li class="dropdown active">';
		$expected .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Test <b class="caret"></b></a>';
		$expected .= '<ul class="dropdown-menu">';
		$expected .= '<li class="active"><a href="/">Home</a></li>';
		$expected .= '<li><a href="/about">About</a></li>';
		$expected .= '<li class="divider"></li>';
		$expected .= '<li><a href="/service">Service</a></li>';
		$expected .= '</ul></li>';

		Request::shouldReceive('url')->once()->andReturn('/');

		$this->assertEquals($expected, $nav->buildDropdown($menu, 'Dropdown Test'));
	}

	public function testCompleteMenuBuild()
	{
		$nav = new NavBuilder();

		$menu = array(
			'Home' => '/',
			'About' => '/about',
			'User' => array(
				'Profile' => '/user/profile',
				'-divider-',
				'Sign out' => '/sign-out',
			),
			'Service' => '/service'
		);

		$expected = '<li class="active"><a href="/">Home</a></li>';
		$expected .= '<li><a href="/about">About</a></li>';

		$expected .= '<li class="dropdown">';
		$expected .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>';
		$expected .= '<ul class="dropdown-menu">';
		$expected .= '<li><a href="/user/profile">Profile</a></li>';
		$expected .= '<li class="divider"></li>';
		$expected .= '<li><a href="/sign-out">Sign out</a></li>';
		$expected .= '</ul></li>';

		$expected .= '<li><a href="/service">Service</a></li>';

		Request::shouldReceive('url')->once()->andReturn('/');

		$this->assertEquals($expected, $nav->build($menu));
	}

}