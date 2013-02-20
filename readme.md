## Nano

Nano size PHP 5.3+ framework

### Features

- PSR-0 Autoloading
- Database (mysql, sqlite)
- RESTful Routing
- Session management (database, memcache, cookies)

#### Hello world

`app/routes.php`

	Route::get('/', function() {
		return 'Hello world';
	});

#### Hooks `before` and `after`

	Route::action('auth', function() {
		if(Auth::guest()) return Response::redirect('login');
	});

	Route::get('/', array('before' => 'auth', 'main' => function() {
		return 'Hello world';
	}));
