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

class config_db_text extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return $this->db_tools->sql_table_exists($this->table_prefix . 'config_text');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array('\phpbb\db\migration\data\v30x\release_3_0_11');
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_schema() {
		return array(
			'add_tables' => array(
				$this->table_prefix . 'config_text' => array(
					'COLUMNS' => array(
						'config_name' => array('VCHAR', ''),
						'config_value' => array('MTEXT', ''),
					),
					'PRIMARY_KEY' => 'config_name',
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
			'drop_tables' => array(
				$this->table_prefix . 'config_text',
			),
		);
	}


}
