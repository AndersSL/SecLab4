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


class acp_language_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'acp_language',
			'title'  => 'ACP_LANGUAGE',
			'modes'  => array(
				'lang_packs'  => array('title' => 'ACP_LANGUAGE_PACKS', 'auth' => 'acl_a_language', 'cat' => array('ACP_LANGUAGE')),
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
