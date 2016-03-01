<?php

/*
 * Home page
 */
System\Route::get(array('/', 'home'), function() {
	$words = array('Welcome', 'Bienvenue', 'Willkommen', 'Bienvenido');
	$vars['welcome'] = System\Arr::create($words)->shuffle()->first();

	return System\View::home($vars);
});
