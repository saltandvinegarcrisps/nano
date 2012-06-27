<?php

class Route {

	private $action, $args = array();

	public static function __callStatic($method, $arguments) {
		if(in_array($method, array('get', 'post', 'any')) === false) {
			return false;
		}

		list($route, $action) = $arguments;

		foreach(explode(',', $route) as $http) {
			Router::register($method, $http, $action);
		}
	}

	public function __construct($action, $args = array()) {
		$this->action = $action;
		$this->args = $args;
	}

	public function call() {
		$response = call_user_func_array($this->action, $this->args);

		if($response instanceof Response) {
			return $response;
		}
		
		return new Response($response);
	}

}