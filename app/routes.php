<?php

/*
 * Home page
 */
Route::get(array('/', 'home'), function() {
	$words = array('Welcome', 'Bienvenue', 'Willkommen', 'Selamat datang', 'Bienvenido');
	$vars['welcome'] = Arr::create($words)->shuffle()->first();

	return View::home($vars);
});

/*
 * 404 catch all
 */
Route::any(':all', function() {
	return Response::error(404);
});