<?php

/*
 * Error reporting
 */
ini_set('display_error', true);
error_reporting(-1);

/**
 * Register composer autoloader
 */
$composer = require PATH . 'vendor/autoload' . EXT;
$composer->add('', APP . 'src');

/*
 * Set your applications current timezone
 */
date_default_timezone_set(System\Config::app('timezone', 'UTC'));

/**
 * Import helpers
 */
require APP . 'helpers' . EXT;

/**
 * Import defined routes
 */
require APP . 'routes' . EXT;

/**
 * Error handling
 */
System\Error::register();

/**
 * Set input
 */
System\Input::detect(System\Request::method());

/**
 * Read session data
 */
System\Session::start();

/**
 * Route the request
 */
$response = System\Router::create()->dispatch();

/**
 * Output stuff
 */
$response->send();
