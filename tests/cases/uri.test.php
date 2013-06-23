<?php

class UriTest extends PHPUnit_Framework_TestCase {

	/**
	 * Uri::current()
	 */
	public function testCurrentUsingRequestUri() {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'REQUEST_URI' => '/app',
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), '/');
	}

	public function testCurrentUsingRequestUriStralingSlash() {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'REQUEST_URI' => '/app/',
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), '/');
	}

	public function testCurrentUsingRequestUriQueryString() {
		$_SERVER = array(
			'SCRIPT_NAME' => '/app/index.php',
			'REQUEST_URI' => '/app/my/page?offset=1',
		);

		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');
		Uri::$current = null;

		$this->assertEquals(Uri::current(), 'my/page');
	}

	/**
	 * Uri::to()
	 */
	public function testToWithUrlIndex() {
		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::to('help'), '/app/index.php/help');
	}

	public function testToWithNoIndex() {
		Config::set('app.url', '/app');
		Config::set('app.index', '');

		$this->assertEquals(Uri::to('help'), '/app/help');
	}

	public function testToWithNone() {
		Config::set('app.url', '');
		Config::set('app.index', '');

		$this->assertEquals(Uri::to('help'), '/help');
	}

	/**
	 * Uri::full()
	 */
	public function testFull() {
		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::full('help'), 'http://localhost/app/index.php/help');
	}

	/**
	 * Uri::secure()
	 */
	public function testSecure() {
		Config::set('app.url', '/app');
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::secure('help'), 'https://localhost/app/index.php/help');
	}


}