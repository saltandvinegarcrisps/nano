<?php

return array(
	/*
	 * The default database configuration to use
	 */
	'default' => 'sqlite',

	/*
	 * Query logging
	 *
	 * When set to True all queries are stored and can be
	 * retreived using DB::profile();
	 */
	'profiling' => true,

	/*
	 * Array of database connections available
	 *
	 * DB::connection() // will return the default
	 * DB::connection('mysql') // will return the 'mysql' connection
	 */
	'connections' => array(
		'sqlite' => array(
			'driver' => 'sqlite',
			'database' => ':memory:'
		),

		'mysql' => array(
			'driver' => 'mysql',
			'hostname' => 'localhost',
			'port' => 3306,
			'username' => 'root',
			'password' => '',
			'database' => '',
			'charset' => 'utf8'
		)
	)
);