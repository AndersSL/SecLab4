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


namespace phpbb\passwords\driver;

class sha1_smf extends base
{
	const PREFIX = '$smf$';

	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_prefix() {
		return self::PREFIX;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_legacy() {
		return true;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $password
	 * @param unknown $user_row (optional)
	 * @return unknown
	 */
	public function hash($password, $user_row = '') {
		return (isset($user_row['login_name'])) ? sha1(strtolower($user_row['login_name']) . $password) : false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $password
	 * @param unknown $hash
	 * @param unknown $user_row (optional)
	 * @return unknown
	 */
	public function check($password, $hash, $user_row = array()) {
		return (strlen($hash) == 40) ? $this->helper->string_compare($hash, $this->hash($password, $user_row)) : false;
	}


}
