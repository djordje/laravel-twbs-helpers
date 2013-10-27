<?php namespace Djordje\LaravelTwbsHelpers\tests\Html;

use Djordje\LaravelTwbsHelpers\Html\ListGroupBuilder;
use Illuminate\Support\Facades\Request;
use Mockery;

class ListGroupBuilderTest extends \PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		Mockery::close();
	}

	public function testUnorderList()
	{
		$list = new ListGroupBuilder();

		$menu = array(
			'wrapper' => 'ul',
			'child' => 'li',
			'items' => array('One', 'Two', 'Three')
		);
		$expected = '<ul class="list-group">';
		$expected .= '<li class="list-group-item">One</li>';
		$expected .= '<li class="list-group-item">Two</li>';
		$expected .= '<li class="list-group-item">Three</li>';
		$expected .= '</ul>';

		$this->assertEquals($expected, $list->build($menu));

		$list = new ListGroupBuilder();

		$menu = array(
			'child' => 'li',
			'items' => array('One', 'Two', 'Three')
		);
		$expected = '<ul class="list-group">';
		$expected .= '<li class="list-group-item">One</li>';
		$expected .= '<li class="list-group-item">Two</li>';
		$expected .= '<li class="list-group-item">Three</li>';
		$expected .= '</ul>';

		$this->assertEquals($expected, $list->build($menu));

		$list = new ListGroupBuilder();

		$menu = array(
			'wrapper' => 'div',
			'child' => 'li',
			'items' => array('One', 'Two', 'Three')
		);
		$expected = '<ul class="list-group">';
		$expected .= '<li class="list-group-item">One</li>';
		$expected .= '<li class="list-group-item">Two</li>';
		$expected .= '<li class="list-group-item">Three</li>';
		$expected .= '</ul>';

		$this->assertEquals($expected, $list->build($menu));
	}

	public function testDiv()
	{
		$list = new ListGroupBuilder();

		$menu = array(
			'items' => array('One', 'Two', 'Three')
		);
		$expected = '<div class="list-group">';
		$expected .= '<a href="#" class="list-group-item">One</a>';
		$expected .= '<a href="#" class="list-group-item">Two</a>';
		$expected .= '<a href="#" class="list-group-item">Three</a>';
		$expected .= '</div>';

		Request::shouldReceive('url')->times(3)->andReturn('/');

		$this->assertEquals($expected, $list->build($menu));
	}

	public function testWrapperAndChildSetup()
	{
		$list = new ListGroupBuilder();

		$menu = array(
			'wrapper' => 'nav',
			'child' => 'p',
			'items' => array('One', 'Two', 'Three')
		);
		$expected = '<nav class="list-group">';
		$expected .= '<p class="list-group-item">One</p>';
		$expected .= '<p class="list-group-item">Two</p>';
		$expected .= '<p class="list-group-item">Three</p>';
		$expected .= '</nav>';

		$this->assertEquals($expected, $list->build($menu));
	}

	public function testDivAndActiveLink()
	{
		$list = new ListGroupBuilder();

		$menu = array(
			'items' => array(
				array('Home', 'href' => '/'),
				array('Two', 'href' => '/two'),
				'Three'
			)
		);
		$expected = '<div class="list-group">';
		$expected .= '<a href="/" class="list-group-item active">Home</a>';
		$expected .= '<a href="/two" class="list-group-item">Two</a>';
		$expected .= '<a href="#" class="list-group-item">Three</a>';
		$expected .= '</div>';

		Request::shouldReceive('url')->times(3)->andReturn('/');

		$this->assertEquals($expected, $list->build($menu));
	}

	public function testMassiveContent()
	{
		$list = new ListGroupBuilder();

		$menu = array(
			'items' => array(
				array('Test <span class="badge">3</span>', 'href' => '/'),
				'<span class="list-group-item-heading">Heading</span><span class="list-group-item-text">Text</span>'
			)
		);
		$expected = '<div class="list-group">';
		$expected .= '<a href="/" class="list-group-item active">Test <span class="badge">3</span></a>';
		$expected .= '<a href="#" class="list-group-item">';
		$expected .= '<span class="list-group-item-heading">Heading</span><span class="list-group-item-text">Text</span>';
		$expected .= '</a>';
		$expected .= '</div>';

		Request::shouldReceive('url')->times(3)->andReturn('/');

		$this->assertEquals($expected, $list->build($menu));
	}

}