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
class phpbb_mock_notification_manager {

	/**
	 *
	 * @return unknown
	 */
	public function load_notifications() {
		return array(
			'notifications'  => array(),
			'unread_count'  => 0,
		);
	}


	/**
	 *
	 */
	public function mark_notifications() {
	}


	/**
	 *
	 */
	public function mark_notifications_by_parent() {
	}


	/**
	 *
	 */
	public function mark_notifications_by_id() {
	}


	/**
	 *
	 * @return unknown
	 */
	public function add_notifications() {
		return array();
	}


	/**
	 *
	 */
	public function add_notifications_for_users() {
	}


	/**
	 *
	 */
	public function update_notifications() {
	}


	/**
	 *
	 */
	public function delete_notifications() {
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_subscription_types() {
		return array();
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_subscription_methods() {
		return array();
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_global_subscriptions() {
		return array();
	}


	/**
	 *
	 */
	public function add_subscription() {
	}


	/**
	 *
	 */
	public function delete_subscription() {
	}


	/**
	 *
	 */
	public function load_users() {
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_user() {
		return null;
	}


}
