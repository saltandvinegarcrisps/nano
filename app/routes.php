<?php

/*
 * Home page
 */
Route::get(array('/', 'home'), function() {
	$words = array('Welcome', 'Bienvenue', 'Willkommen', 'Bienvenido');
	$vars['welcome'] = Arr::create($words)->shuffle()->first();

	return View::home($vars);
});

/*
 * 404 not found
 */
Route::not_found(function() {
	if(Request::cli()) {
		$text = 'Resource not found';

		if('win' === strtolower(substr(PHP_OS, 0, 3))) {
			return $text . PHP_EOL;
		}

		return sprintf("\033[1;31m%s\033[0m", $text) . PHP_EOL;
	}

	return Response::error(404);
});