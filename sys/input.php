<?php

class Input {

	public static $array = array();

	public static function get($key, $default = null) {
		if(array_key_exists($key, static::$array)) {
			return static::$array[$key];
		}

		return $default;
	}

}
