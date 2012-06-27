<?php

class Html {

	public static function encode($str) {
		return htmlentities($str, ENT_QUOTES, 'UTF-8', false);
	}

}