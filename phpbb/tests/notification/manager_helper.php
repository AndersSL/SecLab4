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
 *
 * @ignore
 */
if (!defined('IN_PHPBB')) {
	exit;
}

/**
 * Notifications service class
 */
class phpbb_notification_manager_helper extends \phpbb\notification\manager
{

	/**
	 *
	 * @param unknown $name
	 * @param unknown $value
	 */
	public function set_var($name, $value) {
		$this->$name = $value;
	}


	// Extra dependencies for get_*_class functions
	protected $auth = null;
	protected $config = null;

	/**
	 *
	 * @param unknown $auth
	 * @param unknown $config
	 */
	public function setDependencies($auth, $config) {
		$this->auth = $auth;
		$this->config = $config;
	}


}
