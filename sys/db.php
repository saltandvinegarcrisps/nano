<?php

class Db {

	private static $connection;

	public static function connect() {
		$config = require APP . 'config/database' . EXT;
		static::$connection = new PDO('mysql:dbname=' . $config['database'], $config['username'], $config['password']);
	}

	public static function prepare($sql, $bindings = array()) {
		if(is_null(static::$connection)) {
			static::connect();
		}

		$sth = static::$connection->prepare($sql);
		return $sth;
	}

	public static function query($sql, $bindings = array()) {
		$sth = static::prepare($sql);
		$sth->execute($bindings);
		return $sth;
	}

	public static function insert($table, $values) {
		$cols = array();
		$bindings = array_values($values);

		foreach(array_keys($values) as $key) {
			$cols[] = '`' . $key . '`';
		}

		$sql = 'insert into `' . $table . '` (' . implode(',', $cols) . ') values 
			(' . implode(',', str_split(str_repeat('?', count($values)), 1)) . ')';
			
		$sth = static::prepare($sql);
		return $sth->execute($bindings);
	}

	public static function update($table, $values, $where) {
		$cols = array();
		$bindings = array_values($values);

		foreach(array_keys($values) as $key) {
			$cols[] = '`' . $key . '` = ?';
		}

		$sql = 'update `' . $table . '` set ' . implode(',', $cols);
			
		if(count($where)) {
			$clause = array();

			foreach($where as $key => $val) {
				$clause[] = '`' . $key . '` = ?';
				$bindings[] = $val;
			}

			$sql .= ' where ' . implode(' and ', $clause);
		}

		$sth = static::prepare($sql);
		return $sth->execute($bindings);
	}

	public static function delete($table, $where) {
		$sql = 'delete from `' . $table . '`';
			
		if(count($where)) {
			$clause = array();

			foreach($where as $key => $val) {
				$clause[] = '`' . $key . '` = ?';
				$bindings[] = $val;
			}

			$sql .= ' where ' . implode(' and ', $clause);
		}

		$sth = static::prepare($sql);
		return $sth->execute($bindings);
	}

	public static function get($sql, $bindings = array()) {
		$sth = static::query($sql, $bindings);
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetchAll();
	}

	public static function fetch($sql, $bindings = array()) {
		$sth = static::query($sql, $bindings);
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch();
	}

	public static function col($sql, $bindings = array()) {
		$sth = static::query($sql, $bindings);
		return $sth->fetchColumn();
	}

	public static function pair($sql, $bindings = array()) {
		$sth = static::query($sql, $bindings);
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetchAll();
	}

}