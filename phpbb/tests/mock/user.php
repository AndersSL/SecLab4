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
 * Mock user class.
 * This class is used when tests invoke phpBB code expecting to have a global
 * user object, to avoid instantiating the actual user object.
 * It has a minimum amount of functionality, just to make tests work.
 */
class phpbb_mock_user {
	public $host = "testhost";
	public $page = array('root_script_path' => '/');
	public $style = [];
	public $data = [];
	public $lang = [];

	private $options = array();

	/**
	 *
	 * @param unknown $item
	 * @return unknown
	 */
	public function optionget($item) {
		if (!isset($this->options[$item])) {
			throw new Exception(sprintf("You didn't set the option '%s' on the mock user using optionset.", $item));
		}

		return $this->options[$item];
	}


	/**
	 *
	 * @param unknown $item
	 * @param unknown $value
	 */
	public function optionset($item, $value) {
		$this->options[$item] = $value;
	}


	/**
	 *
	 * @param unknown $user_id    (optional)
	 * @param unknown $user_ips   (optional)
	 * @param unknown $user_email (optional)
	 * @param unknown $return     (optional)
	 * @return unknown
	 */
	public function check_ban($user_id = false, $user_ips = false, $user_email = false, $return = false) {
		$banned_users = $this->optionget('banned_users');
		foreach ($banned_users as $banned) {
			if ($banned == $user_id || $banned == $user_ips || $banned == $user_email) {
				return true;
			}
		}
		return false;
	}


	/**
	 *
	 * @return unknown
	 */
	public function lang() {
		return implode(' ', func_get_args());
	}


}
