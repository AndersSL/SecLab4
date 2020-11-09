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


namespace phpbb\log;

/**
 * Dummy logger
 */
class dummy implements log_interface
{

	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $type (optional)
	 * @return unknown
	 */
	public function is_enabled($type = '') {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $type (optional)
	 */
	public function disable($type = '') {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $type (optional)
	 */
	public function enable($type = '') {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $mode
	 * @param unknown $user_id
	 * @param unknown $log_ip
	 * @param unknown $log_operation
	 * @param unknown $log_time        (optional)
	 * @param unknown $additional_data (optional)
	 * @return unknown
	 */
	public function add($mode, $user_id, $log_ip, $log_operation, $log_time = false, $additional_data = array()) {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $mode
	 * @param unknown $conditions (optional)
	 */
	public function delete($mode, $conditions = array()) {
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $mode
	 * @param unknown $count_logs (optional)
	 * @param unknown $limit      (optional)
	 * @param unknown $offset     (optional)
	 * @param unknown $forum_id   (optional)
	 * @param unknown $topic_id   (optional)
	 * @param unknown $user_id    (optional)
	 * @param unknown $log_time   (optional)
	 * @param unknown $sort_by    (optional)
	 * @param unknown $keywords   (optional)
	 * @return unknown
	 */
	public function get_logs($mode, $count_logs = true, $limit = 0, $offset = 0, $forum_id = 0, $topic_id = 0, $user_id = 0, $log_time = 0, $sort_by = 'l.log_time DESC', $keywords = '') {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_log_count() {
		return 0;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_valid_offset() {
		return 0;
	}


}
