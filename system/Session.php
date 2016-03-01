<?php namespace System;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

use ErrorException;
use System\Session\Cargo;

class Session extends \SessionHandler {

	/**
	 * Session Object
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Returns the curren instance of the cargo object
	 *
	 * @return object Cargo
	 */
	public static function instance() {
		if(null === static::$instance) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	/**
	 * Starts session
	 *
	 * @return void
	 */
	public static function start() {
		session_start();
	}

	/**
	 * Magic method to call a method on the session driver
	 *
	 * @param string
	 * @param array
	 */
	public static function __callStatic($method, $arguments) {
		$instance = static::instance();

		return call_user_func_array(array($instance, $method), $arguments);
	}

}
