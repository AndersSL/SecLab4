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


class acp_words_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'acp_words',
			'title'  => 'ACP_WORDS',
			'modes'  => array(
				'words'  => array('title' => 'ACP_WORDS', 'auth' => 'acl_a_words', 'cat' => array('ACP_MESSAGES')),
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
