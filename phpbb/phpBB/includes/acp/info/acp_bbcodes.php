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


class acp_bbcodes_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'acp_bbcodes',
			'title'  => 'ACP_BBCODES',
			'modes'  => array(
				'bbcodes'  => array('title' => 'ACP_BBCODES', 'auth' => 'acl_a_bbcode', 'cat' => array('ACP_MESSAGES')),
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
