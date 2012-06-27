<?php

class Pastes {

	public static function find($where = array()) {
		$sql = 'select * from pastes';
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
		$sql = 'select * from pastes order by date desc';
		$uri = '/pastes/';
		return new Paging($sql, array(), $uri, $offset, $limit);
	}

	public static function search($query, $offset = 0, $limit = 10) {
		$sql = 'select * from pastes where (title like :query) order by date desc';
		$bindings = array('query' => '%' . preg_replace('/\W+/', '%', $query) . '%');
		$uri = '/pastes/search/' . $query . '/';

		return new Paging($sql, $bindings, $uri, $offset, $limit);
	}

	public static function add() {
		$fields = array('title', 'text');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['title'])) {
			return false;
		}

		$sql = 'select id from pastes where slug = ? limit 1';
		$len = 1;

		do {
			$slug = Str::random(++$len);
		} while(Db::fetch($sql, array($slug)));

		$input['slug'] = $slug;
		$input['date'] = date('c');

		return Db::insert('pastes', $input);
	}

	public static function update($id) {
		$fields = array('title', 'text');
		$input = array();

		foreach($fields as $field) {
			$input[$field] = Input::get($field);
		}

		if(empty($input['title'])) {
			return false;
		}

		return Db::update('pastes', $input, array('id' => $id));
	}

	public static function delete($id) {
		return Db::delete('pastes', array('id' => $id));
	}

}