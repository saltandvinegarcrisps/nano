<?php

return array(
	// Application URL
	'url' => rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'),

	// Application Index
	'index' => 'index.php',

	// Application Timezone
	'timezone' => 'Europe/London',

	// Application Key
	'key' => hash('md5', 'Change me!'),

	// Default Application Language
	'language' => 'en_GB',

	// Application Character Encoding
	'encoding' => 'UTF-8',

	// Your application class aliases
	'aliases' => array(
		'Arr' => 'System\\Arr',
		'Autoloader' => 'System\\Autoloader',
		'Config' => 'System\\Config',
		'Cookie' => 'System\\Cookie',
		'Database' => 'System\\Database',
		'Error' => 'System\\Error',
		'Input' => 'System\\Input',
		'Query' => 'System\\Database\\Query',
		'Record' => 'System\\Database\\Record',
		'Request' => 'System\\Request',
		'Response' => 'System\\Response',
		'Route' => 'System\\Route',
		'Router' => 'System\\Router',
		'Session' => 'System\\Session',
		'Uri' => 'System\\Uri',
		'View' => 'System\\View'
	)
);