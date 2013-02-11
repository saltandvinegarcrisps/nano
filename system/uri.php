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

class Uri {

	/**
	 * The current uri
	 *
	 * @var string
	 */
	public static $current;

	/**
	 * Get the current uri string
	 *
	 * @return string
	 */
	public static function current() {
		if(static::$current) return static::$current;

		return static::detect();
	}

	/**
	 * Try and detect the current uri
	 *
	 * @return string
	 */
	public static function detect() {
		$try = array('PATH_INFO', 'REQUEST_URI');

		foreach($try as $method) {
			if($uri = Arr::get($_SERVER, $method)) {
				if(($uri = parse_url($uri, PHP_URL_PATH)) === false) {
					throw new ErrorException('Malformed URI');
				}

				return (static::$current = static::format($uri));
			}
		}
	}

	/**
	 * Format the uri string remove any malicious
	 * characters and relative paths
	 *
	 * @param string
	 * @return string
	 */
	public static function format($uri) {
		// decode hex values in uri
		$uri = rawurldecode($uri);

		// strip bad stuff
		$uri = filter_var($uri, FILTER_SANITIZE_URL);

		// remove script path/name
		$uri = static::remove(Arr::get($_SERVER, 'SCRIPT_NAME'), $uri);

		// remove relative url and index file set in application
		$index = Config::app('index');
		$url = Config::app('url');

		$uri = static::remove($index, static::remove($url, $uri));

		return trim($uri, '/') ?: '/';
	}

	/**
	 * Remove a value from the start of a string
	 * in this case the passed uri string
	 *
	 * @param string
	 * @param string
	 * @return string
	 */
	public static function remove($value, $uri) {
		if( ! strlen($value)) return $uri;

		if(strpos($uri, $value) === 0) {
			return substr($uri, strlen($value));
		}

		return $uri;
	}

}