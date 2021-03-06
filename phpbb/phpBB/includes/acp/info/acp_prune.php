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


class acp_prune_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'acp_prune',
			'title'  => 'ACP_PRUNING',
			'modes'  => array(
				'forums' => array('title' => 'ACP_PRUNE_FORUMS', 'auth' => 'acl_a_prune', 'cat' => array('ACP_MANAGE_FORUMS')),
				'users'  => array('title' => 'ACP_PRUNE_USERS', 'auth' => 'acl_a_userdel', 'cat' => array('ACP_CAT_USERS')),
			),
		);
	}


	/**
	 *
	 */
	function install() {
	}


	/**
	 *
	 */
	function uninstall() {
	}


}
