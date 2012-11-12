<?php

/**
 * Get an item from an array using "dot" notation.
 */
function array_get($array, $key, $default = null) {
	if(is_null($key)) return $array;

	foreach(explode('.', $key) as $segment) {
		if(!is_array($array) or !array_key_exists($segment, $array)) {
			return value($default);
		}

		$array = $array[$segment];
	}

	return $array;
}

/**
 * Set an array item to a given value using "dot" notation.
 */
function array_set(&$array, $key, $value) {

	if (is_null($key)) return $array = $value;

	$keys = explode('.', $key);

	while(count($keys) > 1) {
		$key = array_shift($keys);

		if(!isset($array[$key]) or !is_array($array[$key])) {
			$array[$key] = array();
		}

		$array =& $array[$key];
	}

	$array[array_shift($keys)] = $value;
}

/**
 * Remove an array item from a given array using "dot" notation.
 */
function array_forget(&$array, $key) {
	$keys = explode('.', $key);

	while(count($keys) > 1) {
		$key = array_shift($keys);

		if( ! isset($array[$key]) or ! is_array($array[$key])) {
			return;
		}

		$array =& $array[$key];
	}

	unset($array[array_shift($keys)]);
}

/**
 * Recursively remove slashes from array keys and values.
 */
function array_strip_slashes($array) {
	$result = array();

	foreach($array as $key => $value) {
		$key = stripslashes($key);

		if(is_array($value)) {
			$result[$key] = array_strip_slashes($value);
		}
		else {
			$result[$key] = stripslashes($value);
		}
	}

	return $result;
}

/**
 * Determine if "Magic Quotes" are enabled on the server.
 */
function magic_quotes() {
	return function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc();
}

/**
 * Return the value of the given item.
 */
function value($value) {
	return ($value instanceof Closure) ? call_user_func($value) : $value;
}

/**
 * Cap a string with a single instance of the given string.
 */
function str_finish($value, $cap) {
	return rtrim($value, $cap) . $cap;
}

/**
 * Determine if a given string begins with a given value.
 */
function starts_with($haystack, $needle) {
	return strpos($haystack, $needle) === 0;
}

/**
 * Determine if a given string ends with a given value.
 */
function ends_with($haystack, $needle) {
	return $needle == substr($haystack, strlen($haystack) - strlen($needle));
}

/**
 * Data dump
 */
function dd() {
	echo '<pre>';
	call_user_func_array('var_dump', func_get_args());
	echo '</pre>';
	exit;
}

/**
 * Determine if the current version of PHP is at least the supplied version.
 */
function has_php($version) {
	return version_compare(PHP_VERSION, $version) >= 0;
}

/**
 * Generate an application URL to an asset.
 */
function asset($uri) {
	return str_finish(Config::get('application.url'), '/') . $uri;
}