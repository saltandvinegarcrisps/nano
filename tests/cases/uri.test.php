<?php

class UriTest extends PHPUnit_Framework_TestCase {

	public function testCurrent()  {
		// uri: http://domain.app/home/index.php/help
		// path: /home/user/domain.app/public/home/index.php

		$_SERVER['SCRIPT_NAME'] = '/home/index.php';
		$_SERVER['REQUEST_URI'] = '/home/index.php';
		$_SERVER['PATH_INFO'] = '/help';

		Config::set('app.url', dirname($_SERVER['SCRIPT_NAME']));
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::current(), 'help');

		// uri: http://domain.app/home/help
		// path: /home/user/domain.app/public/home/index.php

		$_SERVER['SCRIPT_NAME'] = '/home/index.php';
		$_SERVER['REQUEST_URI'] = '/home/help';
		$_SERVER['PATH_INFO'] = '/home/help';

		Config::set('app.url', dirname($_SERVER['SCRIPT_NAME']));
		Config::set('app.index', '');

		$this->assertEquals(Uri::current(), 'help');
	}

	public function testTo()  {
		// uri: http://domain.app/home/index.php/help
		// path: /home/user/domain.app/public/home/index.php

		$_SERVER['SCRIPT_NAME'] = '/home/index.php';
		$_SERVER['REQUEST_URI'] = '/home/index.php';
		$_SERVER['PATH_INFO'] = '/help';

		Config::set('app.url', dirname($_SERVER['SCRIPT_NAME']));
		Config::set('app.index', 'index.php');

		$this->assertEquals(Uri::to('help'), '/home/index.php/help');

		// uri: http://domain.app/home/help
		// path: /home/user/domain.app/public/home/index.php

		$_SERVER['SCRIPT_NAME'] = '/home/index.php';
		$_SERVER['REQUEST_URI'] = '/home/help';
		$_SERVER['PATH_INFO'] = '/help';

		Config::set('app.url', dirname($_SERVER['SCRIPT_NAME']));
		Config::set('app.index', '');

		$this->assertEquals(Uri::to('help'), '/home/help');
	}

}