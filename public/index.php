<?php

// tick tock
define('START', microtime(true));

define('DS', DIRECTORY_SEPARATOR);
define('EXT', '.php');

define('PATH', pathinfo(dirname(__FILE__), PATHINFO_DIRNAME) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'sys' . DS);

require APP . 'bootstrap' . EXT;