<?php namespace System;

class Uri {

	public static function current() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	public static function make($path = '') {
		// return full urls
		if(strpos($path, '://') !== false) {
			return $path;
		}

		$base_url = Config::get('application.base_url');

		if($base_url) {
			if(strpos($path, $base_url) === 0) {
				$path = substr($path, strlen($base_url));
			}
		}

		$index_page = Config::get('application.index_page');

		if($index_page) {
			if(strpos($path, $index_page) === 0) {
				$path = substr($path, strlen($index_page));
			}
		}

		$url = $base_url;

		if($index_page) {
			$url .= $index_page . '/';
		}

		return $url . ltrim($path, '/');
	}

}