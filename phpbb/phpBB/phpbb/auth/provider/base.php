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


namespace phpbb\auth\provider;

/**
 * Base authentication provider class that all other providers should implement
 */
abstract class base implements provider_interface
{

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		return;
	}


	/**
	 * {@inheritdoc}
	 */
	public function autologin() {
		return;
	}


	/**
	 * {@inheritdoc}
	 */
	public function acp() {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $new_config
	 */
	public function get_acp_template($new_config) {
		return;
	}


	/**
	 * {@inheritdoc}
	 */
	public function get_login_data() {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $user_id (optional)
	 */
	public function get_auth_link_data($user_id = 0) {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $data
	 * @param unknown $new_session
	 */
	public function logout($data, $new_session) {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $user
	 */
	public function validate_session($user) {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $login_link_data
	 */
	public function login_link_has_necessary_data($login_link_data) {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param array   $link_data
	 */
	public function link_account(array $link_data) {
		return;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param array   $link_data
	 */
	public function unlink_account(array $link_data) {
		return;
	}


}
