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


require_once dirname(__FILE__) . '/../../phpBB/includes/functions_user.php';

class phpbb_get_banned_user_ids_test extends phpbb_database_test_case
{

	/**
	 *
	 * @return unknown
	 */
	public function getDataSet() {
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/banned_users.xml');
	}


	/**
	 *
	 * @return unknown
	 */
	public function phpbb_get_banned_user_ids_data() {
		return array(
			// Input to phpbb_get_banned_user_ids (user_id list, ban_end)
			// Expected output
			array(
				// True to get users currently banned
				array(array(1, 2, 4, 5, 6), true),
				array(2 => 2, 5 => 5),
			),
			array(
				// False to only get permanently banned users
				array(array(1, 2, 4, 5, 6), false),
				array(2 => 2),
			),
			array(
				// Unix timestamp to get users banned until that time
				array(array(1, 2, 4, 5, 6), 2),
				array(2 => 2, 5 => 5, 6 => 6),
			),
		);
	}


	/**
	 *
	 */
	protected function setUp(): void
	{
		global $db;

		$db = $this->new_dbal();

		parent::setUp();
	}


	/**
	 *
	 * @dataProvider phpbb_get_banned_user_ids_data
	 * @param unknown $input
	 * @param unknown $expected
	 */
	public function test_phpbb_get_banned_user_ids($input, $expected) {
		$this->assertEquals($expected, call_user_func_array('phpbb_get_banned_user_ids', $input));
	}


}
