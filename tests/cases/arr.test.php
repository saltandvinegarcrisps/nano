<?php

class ArrTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->payload = array('books' => array('first' => array('name' => 'First Book')));
	}

	public function testGet()  {
		$this->assertEquals(Arr::get($this->payload, 'books.first.name'), 'First Book');
	}

	public function testSet()  {
		Arr::set($this->payload, 'books.first.author', 'First Author');

		$this->assertEquals(Arr::get($this->payload, 'books.first.author'), 'First Author');

		Arr::set($this->payload, 'books.second.name', 'Second Book');

		$this->assertEquals(Arr::get($this->payload, 'books.second.name'), 'Second Book');
	}

	public function testErase()  {
		Arr::erase($this->payload, 'books.first.author', 'First Author');

		$this->assertEquals(Arr::get($this->payload, 'books.first.author'), null);
	}

}