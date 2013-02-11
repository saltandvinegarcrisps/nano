<?php

return array(
	'default' => 'sqlite',

	'connections' => array(
		'sqlite' => array(
			'driver' => 'sqlite',
			'database' => ':memory:', //APP . 'storage/databases/app.db'
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