<?php

/*
	Home page
*/
Route::get('/, /home', function() {
	return new View('home');
});

/*
	404 catch all
*/
Route::any('*', function() {
	return Response::error(404);
});