<?php namespace System\Database;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

abstract class Connector {

	/**
	 * Holds the php pdo instance
	 *
	 * @var object
	 */
	private $pdo;

	/**
	 * All connectors will implement a function to return the pdo instance
	 *
	 * @param object PDO Object
	 */
	abstract public function instance();

}