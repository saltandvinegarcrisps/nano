<?php

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

define('START_TIME', microtime(true));
define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));

define('PATH', dirname(__DIR__) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

require APP . 'run' . EXT;
