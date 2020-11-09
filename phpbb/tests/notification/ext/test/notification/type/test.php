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


namespace phpbb\notification\type;

/**
 *
 * @ignore
 */
if (!defined('IN_PHPBB')) {
	exit;
}

class test extends \phpbb\notification\type\base
{

	/**
	 *
	 * @return unknown
	 */
	public function get_type() {
		return 'test';
	}


	/**
	 *
	 * @param unknown $post
	 * @return unknown
	 */
	public static function get_item_id($post) {
		return (int) $post['post_id'];
	}


	/**
	 *
	 * @param unknown $post
	 * @return unknown
	 */
	public static function get_item_parent_id($post) {
		return (int) $post['topic_id'];
	}


	/**
	 *
	 * @param unknown $post
	 * @param unknown $options (optional)
	 * @return unknown
	 */
	public function find_users_for_notification($post, $options = array()) {
		return $this->check_user_notification_options(array(0), $options);
	}


	/**
	 *
	 * @param unknown $post
	 * @param unknown $pre_create_data (optional)
	 */
	public function create_insert_array($post, $pre_create_data = array()) {
		$this->notification_time = $post['post_time'];

		parent::create_insert_array($post, $pre_create_data);
	}


	/**
	 *
	 * @param unknown $type_data
	 * @return unknown
	 */
	public function create_update_array($type_data) {
		$this->create_insert_array($type_data);
		$data = $this->get_insert_array();

		// Unset data unique to each row
		unset(
			$data['notification_id'],
			$data['notification_read'],
			$data['user_id']
		);

		return $data;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_title() {
		return 'test title';
	}


	/**
	 *
	 * @return unknown
	 */
	public function users_to_query() {
		return array();
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_url() {
		return '';
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_email_template() {
		return false;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_email_template_variables() {
		return array();
	}


}
