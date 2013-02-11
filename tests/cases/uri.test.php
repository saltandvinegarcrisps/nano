<?php

class UriTest extends PHPUnit_Framework_TestCase {

	public function testCurrent()  {
		Config::set('app.url', '/myapp/public/');
		Config::set('app.index', 'index.php');

		$_SERVER['PATH_INFO'] = '/myapp/public/index.php/home';

		$this->assertEquals(Uri::current(), 'home');

		$_SERVER['PATH_INFO'] = '/myapp/public/index.php';

		$this->assertEquals(Uri::current(), 'home');

		$_SERVER['PATH_INFO'] = '/myapp/public/';

		$this->assertEquals(Uri::current(), 'home');

		$_SERVER['PATH_INFO'] = '/myapp/public';

		$this->assertEquals(Uri::current(), 'home');
	}

}