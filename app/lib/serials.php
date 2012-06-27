<?php

class Serials {

	public static function find($where = array()) {
		$sql = 'select * from serials';
		$bindings = array();

		if(count($where)) {
			$clause = array();

			foreach($where as $key => $val) {
				$clause[] = '`' . $key . '` = ?';
				$bindings[] = $val;
			}

			$sql .= ' where ' . implode(' and ', $clause);
		}

		return Db::fetch($sql, $bindings);
	}

	public static function list_all($offset = 0, $limit = 10) {
		$sql = 'select * from serials order by title asc';
		$uri = '/serials/';
		return new Paging($sql, array(), $uri, $offset, $limit);
	}

	public static function search($query, $offset = 0, $limit = 10) {
		$sql = 'select * from serials where (title like :query or serial like :query) order by title asc';
		$bindings = array('query' => '%' . preg_replace('/\W+/', '%', $query) . '%');
		$uri = '/serials/search/' . $query . '/';

		return new Paging($sql, $bindings, $uri, $offset, $limit);
	}

	public static function add() {
		$fields = array('title', 'os', 'serial', 'comments');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['title'])) {
			return false;
		}

		return Db::insert('serials', $input);
	}

	public static function update($id) {
		$fields = array('title', 'os', 'serial', 'comments');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['title'])) {
			return false;
		}

		return Db::update('serials', $input, array('id' => $id));
	}

	public static function delete($id) {
		return Db::delete('serials', array('id' => $id));
	}

}