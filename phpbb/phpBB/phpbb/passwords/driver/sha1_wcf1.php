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

class sha1_wcf1 extends base
{
	const PREFIX = '$wcf1$';

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
		// Do not support hashing
		return false;
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
		if (empty($hash) || strlen($hash) != 40 || !isset($user_row['user_passwd_salt'])) {
			return false;
		}
		else {
			// Works for standard WCF 1.x, i.e. WBB3 and similar
			return $this->helper->string_compare($hash, sha1($user_row['user_passwd_salt'] . sha1($user_row['user_passwd_salt'] . sha1($password))));
		}
	}


}
