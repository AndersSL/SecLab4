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


include_once __DIR__ . '/test_row_based_plugin.php';

class phpbb_textreparser_user_signature_test extends phpbb_textreparser_test_row_based_plugin
{

	/**
	 *
	 * @return unknown
	 */
	public function getDataSet() {
		return $this->createXMLDataSet(__DIR__ . '/fixtures/users.xml');
	}


	/**
	 *
	 * @return unknown
	 */
	protected function get_reparser() {
		return new \phpbb\textreparser\plugins\user_signature($this->db, USERS_TABLE);
	}


}
