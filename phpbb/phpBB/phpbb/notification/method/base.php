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


namespace phpbb\notification\method;

/**
 * Base notifications method class
 */
abstract class base implements \phpbb\notification\method\method_interface
{
	/** @var \phpbb\notification\manager */
	protected $notification_manager;

	/**
	 * Queue of messages to be sent
	 *
	 * @var array
	 */
	protected $queue = array();

	/**
	 * Set notification manager (required)
	 *
	 * @param \phpbb\notification\manager $notification_manager
	 */
	public function set_notification_manager(\phpbb\notification\manager $notification_manager) {
		$this->notification_manager = $notification_manager;
	}


	/**
	 * Is the method enable by default?
	 *
	 * @return bool
	 */
	public function is_enabled_by_default() {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification_type_id
	 * @param array   $options
	 * @return unknown
	 */
	public function get_notified_users($notification_type_id, array $options) {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param array   $options (optional)
	 * @return unknown
	 */
	public function load_notifications(array $options = array()) {
		return array(
			'notifications'  => array(),
			'unread_count'  => 0,
			'total_count'  => 0,
		);
	}


	/**
	 * Add a notification to the queue
	 *
	 * @param \phpbb\notification\type\type_interface $notification
	 */
	public function add_to_queue(\phpbb\notification\type\type_interface $notification) {
		$this->queue[] = $notification;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification
	 * @param array   $data
	 * @param array   $options
	 */
	public function update_notification($notification, array $data, array $options) {
	}


	/**
	 * {@inheritdoc
	 *
	 * @param unknown $notification_type_id
	 * @param unknown $item_id
	 * @param unknown $user_id
	 * @param unknown $time                 (optional)
	 * @param unknown $mark_read            (optional)
	 */
	public function mark_notifications($notification_type_id, $item_id, $user_id, $time = false, $mark_read = true) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification_type_id
	 * @param unknown $item_parent_id
	 * @param unknown $user_id
	 * @param unknown $time                 (optional)
	 * @param unknown $mark_read            (optional)
	 */
	public function mark_notifications_by_parent($notification_type_id, $item_parent_id, $user_id, $time = false, $mark_read = true) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification_id
	 * @param unknown $time            (optional)
	 * @param unknown $mark_read       (optional)
	 */
	public function mark_notifications_by_id($notification_id, $time = false, $mark_read = true) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification_type_id
	 * @param unknown $item_id
	 * @param unknown $parent_id            (optional)
	 * @param unknown $user_id              (optional)
	 */
	public function delete_notifications($notification_type_id, $item_id, $parent_id = false, $user_id = false) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $timestamp
	 * @param unknown $only_read (optional)
	 */
	public function prune_notifications($timestamp, $only_read = true) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $notification_type_id
	 */
	public function purge_notifications($notification_type_id) {
	}


	/**
	 * Empty the queue
	 */
	protected function empty_queue() {
		$this->queue = array();
	}


}
