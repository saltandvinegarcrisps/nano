<?php

/*
	Home page
*/
Route::get('/', function() {
	return View::make('home');
});

/*
	404 catch all
*/
Route::any('*', function() {
	return Response::error(404);
});