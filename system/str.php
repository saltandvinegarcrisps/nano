<?php namespace System;

// mbstring support
define('MB_STRING', function_exists('mb_get_info'));

class Str {

	public static function encoding() {
		return Config::get('application.encoding');
	}

	/**
	 * Convert HTML characters to entities.
	 */
	public static function entities($value) {
		return htmlentities($value, ENT_QUOTES, static::encoding(), false);
	}

	/**
	 * Convert a string to lowercase.
	 */
	public static function lower($value) {
		return MB_STRING ? mb_strtolower($value, static::encoding()) : strtolower($value);
	}

	/**
	 * Convert a string to uppercase.
	 */
	public static function upper($value) {
		return MB_STRING ? mb_strtoupper($value, static::encoding()) : strtoupper($value);
	}

	/**
	 * Convert a string to title case (ucwords).
	 */
	public static function title($value) {
		return MB_STRING ? mb_convert_case($value, MB_CASE_TITLE, static::encoding()) : ucwords(strtolower($value));
	}

	/**
	 * Generate a random alpha-numeric string.
	 */
	public static function random($length = 16) {
		$pool = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 1);
		$value = '';

		for($i = 0; $i < $length; $i++)  {
			$value .= $pool[mt_rand(0, 61)];
		}

		return $value;
	}

	/**
	 * Truncate a sentence by words
	 */
	public static function truncate($str, $limit = 10, $elipse = ' [...]') {
		$words = preg_split('/\s+/', $str);

		if(count($words) <= $limit) {
			return $str;
		}

		return implode(' ', array_slice($words, 0, $limit)) . $elipse;
	}

	public static function ascii($value) {
		$foreign = Config::get('strings.foreign_characters');

		$value = preg_replace(array_keys($foreign), array_values($foreign), $value);

		return preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $value);
	}

	public static function slug($title) {
		$title = static::ascii($title);
		$separator = '-';

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', static::lower($title));

		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

		return trim($title, $separator);
	}

}