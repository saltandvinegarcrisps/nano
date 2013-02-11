<?php

class QueryTest extends PHPUnit_Framework_TestCase {

	public function testBuildWhere()  {

		$query = Query::table('books')->where('id', '=', 1);
		$result = 'SELECT * FROM [books] WHERE [id] = ?';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->or_where('id', '=', 1);
		$result = 'SELECT * FROM [books] WHERE [id] = ?';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->where('id', '=', 1)->where('author', '=', 1);
		$result = 'SELECT * FROM [books] WHERE [id] = ? AND [author] = ?';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->where('id', '=', 1)->or_where('author', '=', 1);
		$result = 'SELECT * FROM [books] WHERE [id] = ? OR [author] = ?';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->where('id', '=', 1)->join('authors', 'authors.id', '=', 'books.author');
		$result = 'SELECT * FROM [books] INNER JOIN [authors] ON ([authors].[id] = [books].[author]) WHERE [id] = ?';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->group('id');
		$result = 'SELECT * FROM [books] GROUP BY [id]';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->group('id')->group('author');
		$result = 'SELECT * FROM [books] GROUP BY [id], [author]';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->sort('id');
		$result = 'SELECT * FROM [books] SORT BY [id] ASC';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->sort('id', 'DESC')->sort('author');
		$result = 'SELECT * FROM [books] SORT BY [id] DESC, [author] ASC';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->take(10);
		$result = 'SELECT * FROM [books] LIMIT 10';
		$this->assertEquals($query->build_select(), $result);

		$query = Query::table('books')->take(10)->skip(3);
		$result = 'SELECT * FROM [books] LIMIT 10 OFFSET 3';
		$this->assertEquals($query->build_select(), $result);
	}

}