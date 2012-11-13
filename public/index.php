<?php

/**
 * Nano
 *
 * Lightweight php framework
 *
 * @package		nano
 * @author		k. wilson
 * @link		http://madebykieron.co.uk
 */

define('DS', '/');
define('ENV', getenv('APP_ENV'));

define('PATH', dirname(dirname(__FILE__)) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

require SYS . 'bootstrap' . EXT;