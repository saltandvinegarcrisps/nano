<?php

class Alt {

	private $values = array();
	private $count = 0;
	private $cur = -1;

	public function __construct($values) {
		$this->values = $values;
		$this->count = count($values);
	}

	public function go() {
		return $this->values[$this->cur = ++$this->cur % $this->count];
	}

	public function reset() {
		$this->cur = 0;
	}
	
}