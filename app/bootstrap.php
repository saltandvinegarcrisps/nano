<?php

/*
	Error handling
*/
require SYS . 'error' . EXT;

set_exception_handler(function($e) {
	Error::exception($e);
});

set_error_handler(function($code, $error, $file, $line) {
	Error::native($code, $error, $file, $line);
});

register_shutdown_function(function() {
	Error::shutdown();
});

// report all errors
error_reporting(-1);

/*
	Autoloader
*/
spl_autoload_register(function($class) {
	// The PSR-0 standard indicates that class namespaces and underscores
	// shoould be used to indcate the directory tree in which the class
	// resides, so we'll convert them to slashes.
	$file = str_replace(array('\\', '_'), '/', $class);

	$lower = strtolower($file);

	foreach(array(APP . 'lib' . DS, SYS) as $dir) {
		// Once we have formatted the class name, we'll simply spin through
		// the registered PSR-0 directories and attempt to locate and load
		// the class file into the script.
		if(is_readable($path = $dir . $lower . EXT)) {
			return require $path;
		}
		elseif (is_readable($path = $dir . $file . EXT)) {
			return require $path;
		}
	}
});

/*
	Composer
*/
if(is_readable($composer = PATH . 'vendor/autoload' . EXT)) {
	require $composer;
}

/*
	Magic Quotes Strip Slashes
*/
function magic_quotes() {
	return function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc();
}

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

if(magic_quotes()) {
	$magics = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);

	foreach ($magics as &$magic) {
		$magic = array_strip_slashes($magic);
	}
}

/*
	Set input
*/
switch(Request::method()) {
	case 'get':
		Input::$array = $_GET;
		break;
	case 'post':
		Input::$array = $_POST;
		break;
	default:
		Input::$array = parse_str(file_get_contents('php://input'));
}

/*
	Route the request
*/

// register routes
require APP . 'routes' . EXT;

Router::route(Request::method(), Uri::current())->call()->send();