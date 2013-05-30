## Nano Documentation

- Getting started
- Your App
	- Config
		- Aliases
		- App
		- Cache
		- DB
		- Error
		- Session
	- Libraries
	- Models
	- Storage
	- Views
	- Routing
- Helper functions
- Libraries
	- Arr
	- Autoloader
	- Config
	- Cookie
	- Database
		- Query
		- Record
	- Error
	- Input
	- Request
	- Response
	- Route
	- Router
	- Session
	- Uri
	- View

# Getting started

Donwload the latest version, install on a web server running php 5.3.6 or newer
and run public/index.php from the browser.

# Your App

All your application files are storage in the `app` folder.
The `run.php` will contain all your application specific environment settings.

# Helper functions

`asset($uri)`

Returns a relative url to your app with the appended uri

In `app/config/app.php` the url is set to `blog` like so `'url' => '/blog'`

	asset('css/styles.css'); // returns `/blog/css/styles.css`

`uri_to($uri)`

`dd()`

`noise($size = 32)`

`normalize($str)`

`e($str)`

# Libraries

These are the built in classes nano armed with to provide basic functionality.

## Arr

Array helper

	$arr = Arr::create(['one', 'two', 'three']);

	// return the first element
	$arr->first(); // one

	// return the last element
	$arr->last(); // three

	// shuffle and then return the first element
	$arr->shuffle()->first();

	// static methods

	// return element at index 0
	Arr::get(['one', 'two', 'three'], 0); // one

	$myarray = ['one', 'two', 'three'];

	Arr::set($myarray, 'test', 'four');

	var_dump($myarray); // ['one', 'two', 'three', 'test' => 'four']
