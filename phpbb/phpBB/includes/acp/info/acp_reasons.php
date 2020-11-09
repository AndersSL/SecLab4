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


class acp_reasons_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'acp_reasons',
			'title'  => 'ACP_REASONS',
			'modes'  => array(
				'main'  => array('title' => 'ACP_MANAGE_REASONS', 'auth' => 'acl_a_reasons', 'cat' => array('ACP_GENERAL_TASKS')),
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