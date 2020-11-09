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


namespace phpbb\db\migration\data\v320;

class report_id_auto_increment extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v320\default_data_type_ids',
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_schema() {
		return array(
			'change_columns' => array(
				$this->table_prefix . 'reports'    => array(
					'report_id'  => array('ULINT', null, 'auto_increment'),
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
			'change_columns' => array(
				$this->table_prefix . 'reports'    => array(
					'report_id'  => array('ULINT', 0),
				),
			),
		);
	}


}
