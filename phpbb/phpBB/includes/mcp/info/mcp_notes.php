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


class mcp_notes_info {


	/**
	 *
	 * @return unknown
	 */
	function module() {
		return array(
			'filename' => 'mcp_notes',
			'title'  => 'MCP_NOTES',
			'modes'  => array(
				'front'    => array('title' => 'MCP_NOTES_FRONT', 'auth' => '', 'cat' => array('MCP_NOTES')),
				'user_notes'  => array('title' => 'MCP_NOTES_USER', 'auth' => '', 'cat' => array('MCP_NOTES')),
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
