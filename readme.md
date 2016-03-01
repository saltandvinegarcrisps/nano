## Nano

Nano size PHP 5.3.6+ framework

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
