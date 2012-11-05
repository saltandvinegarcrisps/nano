<?php

define('DS', '/');
define('ENV', (isset($_ENV['APP_ENV']) ? $_ENV['APP_ENV'] : 'production'));

define('PATH', dirname(dirname(__FILE__)) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);

require SYS . 'bootstrap.php';