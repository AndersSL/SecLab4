<?php
/**
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 * @package default
 */


namespace phpbb\event;

use Symfony\Component\EventDispatcher\Event;

class data extends Event implements \ArrayAccess
{
	private $data;

	/**
	 *
	 * @param array   $data (optional)
	 */
	public function __construct(array $data = array()) {
		$this->set_data($data);
	}


	/**
	 *
	 * @param array   $data (optional)
	 */
	public function set_data(array $data = array()) {
		$this->data = $data;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_data() {
		return $this->data;
	}


	/**
	 * Returns data filtered to only include specified keys.
	 *
	 * This effectively discards any keys added to data by hooks.
	 *
	 * @param unknown $keys
	 * @return unknown
	 */
	public function get_data_filtered($keys) {
		return array_intersect_key($this->data, array_flip($keys));
	}


	/**
	 *
	 * @param unknown $offset
	 * @return unknown
	 */
	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}


	/**
	 *
	 * @param unknown $offset
	 * @return unknown
	 */
	public function offsetGet($offset) {
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}


	/**
	 *
	 * @param unknown $offset
	 * @param unknown $value
	 */
	public function offsetSet($offset, $value) {
		$this->data[$offset] = $value;
	}


	/**
	 *
	 * @param unknown $offset
	 */
	public function offsetUnset($offset) {
		unset($this->data[$offset]);
	}


	/**
	 * Returns data with updated key in specified offset.
	 *
	 * @param string  $subarray Data array subarray
	 * @param string  $key      Subarray key
	 * @param mixed   $value    Value to update
	 */
	public function update_subarray($subarray, $key, $value) {
		$this->data[$subarray][$key] = $value;
	}


}
