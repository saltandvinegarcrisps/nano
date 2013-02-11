<?php namespace System\Session;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

use System\Config;
use System\Cookie;

class Cargo {

	/**
	 * Instance of the session driver
	 *
	 * @var array
	 */
	public $driver;

	/**
	 * Session ID
	 *
	 * @var int
	 */
	public $id;

	/**
	 * Session data array
	 *
	 * @var int
	 */
	public $data;

	/**
	 * Create a new instance of the cargo session container
	 *
	 * @param object
	 */
	public function __construct($driver) {
		$this->driver = $driver;

		// use the app key to create a unique flash index name
		$this->key = Config::app('key');
	}

	/**
	 * Implementation of the read method, imports the current
	 * session if found and populates the data array
	 */
	public function read() {
		extract($this->driver->config);

		// read session ID from cookie
		$this->id = Cookie::read($cookie, noise(40));

		// make sure we have some data, if not lets start again
		if(is_null($this->data = $this->driver->read($this->id))) {
			// Cargo has expired lets create a new ID to prevent session fixation
			// https://www.owasp.org/index.php/Session_fixation
			$this->id = noise(40);

			// set the data to an empty array
			$this->data = array();
		}
	}

	/**
	 * Implementation of the write method, commits the session
	 * data using the storage driver
	 */
	public function write() {
		extract($this->driver->config);

		// save session ID
		Cookie::write($cookie, $this->id, ($expire_on_close ? 0 : $lifetime));

		// flash io
		$this->data[$this->key . '_flash_out'] = $this->get($this->key . '_flash_in', array());
		$this->data[$this->key . '_flash_in'] = array();

		// write payload to storage driver
		$this->driver->write($this->id, $this->data);
	}

	/**
	 * Get a item from the session
	 *
	 * @param string
	 * @param mixed
	 */
	public function get($key, $fallback = null) {
		if(array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}

		return $fallback;
	}

	/**
	 * Store a item in the session
	 *
	 * @param string
	 * @param mixed
	 */
	public function put($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Remove a item in the session
	 *
	 * @param string
	 * @param mixed
	 */
	public function erase($key) {
		if(array_key_exists($key, $this->data)) {
			unset($this->data[$key]);
		}
	}

	/**
	 * Gets and sets flash data which is only available for one request
	 *
	 * @param array|null
	 * @return mixed
	 */
	public function flash($data = null) {
		if(is_null($data)) return $this->get($this->key . '_flash_out', array());

		$this->data[$this->key . '_flash_in'] = $data;
	}

}