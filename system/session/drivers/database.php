<?php namespace System\Session\Drivers;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

use System\Session\Driver;
use System\Database\Query;

class Database extends Driver {

	public $exists = false;

	public function read($id) {
		extract($this->config);

		if($result = Query::table($table)->where('id', '=', $id)->where('expire', '>', time())->fetch()) {
			$this->exists = true;

			return unserialize($result->data);
		}
	}

	public function write($id, $cargo) {
		extract($this->config);

		$expire = time() + $lifetime;
		$data = serialize($cargo);

		if($this->exists) {
			Query::table($table)->where('id', '=', $id)->update(array(
				'expire' => $expire,
				'data' => $data));
		}
		else {
			Query::table($table)->insert(array(
				'id' => $id,
				'expire' => $expire,
				'data' => $data));
		}
	}

}