<?php

class Entries {

	public static function find($where = array()) {
		$sql = 'select * from logins';
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
		$sql = 'select * from logins order by client asc, description asc';
		$uri = '/logins/';
		return new Paging($sql, array(), $uri, $offset, $limit);
	}

	public static function search($query, $offset = 0, $limit = 10) {
		$sql = 'select * from logins where (client like :query or description like :query) order by client asc, description asc';
		$bindings = array('query' => '%' . preg_replace('/\W+/', '%', $query) . '%');
		$uri = '/logins/search/' . $query . '/';

		return new Paging($sql, $bindings, $uri, $offset, $limit);
	}

	public static function add() {
		$fields = array('client', 'description', 'username', 'password');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['client'])) {
			return false;
		}

		return Db::insert('logins', $input);
	}

	public static function update($id) {
		$fields = array('client', 'description', 'username', 'password');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['client'])) {
			return false;
		}

		return Db::update('logins', $input, array('id' => $id));
	}

	public static function delete($id) {
		return Db::delete('logins', array('id' => $id));
	}

}