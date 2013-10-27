<?php namespace Djordje\LaravelTwbsHelpers\tests\Html;

use Djordje\LaravelTwbsHelpers\Html\BaseTwbsBuilder;
use Mockery;

class BaseBuilder extends BaseTwbsBuilder {

	public function isActiveLinkTester($link)
	{
		return $this->isActiveLink($link);
	}

}

class BaseTwbsBuilderTest extends \PHPUnit_Framework_TestCase {

	protected $request;
	protected $base;

	protected function setUp()
	{
		$this->request = Mockery::mock('\Illuminate\Http\Request');
		$this->base = new BaseBuilder($this->request);
	}

	protected function tearDown()
	{
		Mockery::close();
	}

	public function testIsActiveLink()
	{
		$this->request->shouldReceive('url')->times(3)->andReturn('http://www.example.com/about');
		$link = array(
			'http://www.example.com/about',
			'http://www.example.com/about/',
			'http://www.example.com/'
		);

		$this->assertTrue($this->base->isActiveLinkTester($link[0]));
		$this->assertTrue($this->base->isActiveLinkTester($link[1]));
		$this->assertFalse($this->base->isActiveLinkTester($link[2]));
	}

}