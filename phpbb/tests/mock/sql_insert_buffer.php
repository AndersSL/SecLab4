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


class phpbb_mock_sql_insert_buffer extends \phpbb\db\sql_insert_buffer
{

	/**
	 *
	 * @return unknown
	 */
	public function flush() {
		return (count($this->buffer)) ? true : false;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_buffer() {
		return $this->buffer;
	}


}
