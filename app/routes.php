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
	if(Request::cli()) return Cli::write('No routes matched', 'light_red');
	return Response::error(404);
});