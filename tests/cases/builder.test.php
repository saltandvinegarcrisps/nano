<?php

use System\Database\Builder;

class MockBuilder extends Builder {
	public $connection;
}

class MockConnection extends Builder {
	public $lwrap = '`';
	public $rwrap = '`';
}

class BuilderTest extends PHPUnit_Framework_TestCase {

	public $builder;

	public function setup() {
		$this->builder = new MockBuilder;
		$this->builder->connection = new MockConnection;
	}

	public function testEnclose()  {
		$result = '`table`.`column`';
		$this->assertEquals($this->builder->enclose('table.column'), $result);

		$result = '`table`.`column`';
		$this->assertEquals($this->builder->enclose($result), $result);

		$result = '`table`.`column` AS `test`';
		$this->assertEquals($this->builder->enclose('table.column as test'), $result);

		$result = '`table`.`column` AS `test`';
		$this->assertEquals($this->builder->enclose($result), $result);
	}

}