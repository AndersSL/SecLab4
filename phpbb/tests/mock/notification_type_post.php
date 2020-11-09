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

class phpbb_mock_notification_type_post extends \phpbb\notification\type\post
{

	/**
	 *
	 * @param unknown $user_loader
	 * @param unknown $db
	 * @param unknown $cache
	 * @param unknown $language
	 * @param unknown $user
	 * @param unknown $auth
	 * @param unknown $config
	 * @param unknown $phpbb_root_path
	 * @param unknown $php_ext
	 * @param unknown $notification_types_table
	 * @param unknown $user_notifications_table
	 */
	public function __construct($user_loader, $db, $cache, $language, $user, $auth, $config, $phpbb_root_path, $php_ext, $notification_types_table, $user_notifications_table) {
		$this->user_loader = $user_loader;
		$this->db = $db;
		$this->cache = $cache;
		$this->language = $language;
		$this->user = $user;
		$this->auth = $auth;
		$this->config = $config;

		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->notification_types_table = $notification_types_table;
		$this->user_notifications_table = $user_notifications_table;
	}


}