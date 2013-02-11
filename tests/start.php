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

define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));

define('PATH', dirname(dirname(__FILE__)) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

require SYS . 'boot' . EXT;