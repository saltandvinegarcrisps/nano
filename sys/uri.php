<?php

class Uri {

	public static function current() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

}