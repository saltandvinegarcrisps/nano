<?php

class UriTest extends PHPUnit_Framework_TestCase {

	public function testCurrentUsingPathinfo()  {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'PATH_INFO' => '/help'
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), 'help');
	}

	public function testCurrentUsingPathinfoStralingSlash()  {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'PATH_INFO' => '/help/'
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), 'help');
	}

	public function testCurrentUsingRequestUri()  {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'REQUEST_URI' => '/app',
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), '/');
	}

	public function testCurrentUsingRequestUriStralingSlash()  {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'REQUEST_URI' => '/app/',
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), '/');
	}

	public function testToWithUrlIndex()  {
		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::to('help'), '/app/index.php/help');
	}

	public function testToWithNoIndex()  {
		Config::set('app.url', '/app');
		Config::set('app.index', '');

		$this->assertEquals(Uri::to('help'), '/app/help');
	}

	public function testToWithNone()  {
		Config::set('app.url', '');
		Config::set('app.index', '');

		$this->assertEquals(Uri::to('help'), '/help');
	}

}