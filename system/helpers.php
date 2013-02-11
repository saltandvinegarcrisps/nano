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

/**
 * Get a relative uri to be used with a view
 *
 * @example asset('styles.css');
 *
 * @param string
 * @return string
 */
function asset($uri) {
	return System\Config::app('url') . '/' . $uri;
}

/**
 * Debugging function, simply a var_dump wrapper
 *
 * @example dd($something, $another);
 *
 * @param mixed
 */
function dd() {
	echo '<pre>';
	call_user_func_array('var_dump', func_get_args());
	echo '</pre>';
	exit;
}

/**
 * Generates a random string
 *
 * @param int Size
 */
function noise($size = 32) {
	$pool = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

	return substr(str_shuffle(str_repeat($pool, 3)), 0, $size);
}