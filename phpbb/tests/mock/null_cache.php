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


class phpbb_mock_null_cache {

	/**
	 *
	 */
	public function __construct() {
	}


	/**
	 *
	 * @param unknown $var_name
	 * @return unknown
	 */
	public function get($var_name) {
		return false;
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $var
	 * @param unknown $ttl      (optional)
	 */
	public function put($var_name, $var, $ttl = 0) {
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $table    (optional)
	 */
	public function destroy($var_name, $table = '') {
	}


	/**
	 *
	 * @return unknown
	 */
	public function obtain_bots() {
		return array();
	}


	/**
	 *
	 * @return unknown
	 */
	public function obtain_word_list() {
		return array();
	}


	/**
	 *
	 * @param unknown $bots
	 */
	public function set_bots($bots) {
	}


	/**
	 *
	 * @param unknown $query_id
	 * @return unknown
	 */
	public function sql_exists($query_id) {
		return false;
	}


}
