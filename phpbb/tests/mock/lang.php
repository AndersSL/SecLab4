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


/**
 * phpbb_mock_lang
 * mock a user with some language-keys specified
 */
class phpbb_mock_lang implements ArrayAccess
{

	/**
	 *
	 * @param unknown $offset
	 * @return unknown
	 */
	public function offsetExists($offset) {
		return true;
	}


	/**
	 *
	 * @param unknown $offset
	 * @return unknown
	 */
	public function offsetGet($offset) {
		return $offset;
	}


	/**
	 *
	 * @param unknown $offset
	 * @param unknown $value
	 */
	public function offsetSet($offset, $value) {
	}


	/**
	 *
	 * @param unknown $offset
	 */
	public function offsetUnset($offset) {
	}


	/**
	 *
	 * @return unknown
	 */
	public function lang() {
		return implode(' ', func_get_args());
	}


}
