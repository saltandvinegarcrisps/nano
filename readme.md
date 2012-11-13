## Nano

Nano size PHP 5.3+ framework

### Features

- PSR-0 Autoloading
- Database (mysql, postgresql)
- Hashing (Secure one way hashing with `crypt`)
- RESTful Routing
- Session management (database, memcache)

#### Helpers

- Forms
- Html
- Input (XSS filtering)
- trings (multibyte support)

#### Utilities

- Config
- Cookie
- Csrf
- Json
- Pagination
- alidation

#### Hello world

`app/routes/routes.php`

	Route::get('/', function() {
		return 'Hello world';
	});

#### Hooks `before` and `after`

	Route::filter('auth', function() {
		if(Auth::guest()) return Response::redirect('login');
	});

	Route::get('/', array('before' => 'auth', 'do' => function() {
		return 'Hello world';
	}));