<?php

define('DS', '/');
define('ENV', getenv('APP_ENV'));

define('PATH', dirname(dirname(__FILE__)) . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);

require SYS . 'bootstrap.php';