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
 * 404 error
 */
Route::error('404', function() {
	return Response::error(404);
});