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


namespace phpbb\db\migration\data\v310;

class profilefield_location_cleanup extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return !$this->db_tools->sql_column_exists($this->table_prefix . 'users', 'user_from');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v310\profilefield_location',
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_schema() {
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'users'   => array(
					'user_from',
				),
			),
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function revert_schema() {
		return array(
			'add_columns' => array(
				$this->table_prefix . 'users'   => array(
					'user_from' => array('VCHAR_UNI:100', ''),
				),
			),
		);
	}


}