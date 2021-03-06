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


require_once dirname(__FILE__) . '/common_test_case.php';

class phpbb_search_postgres_test extends phpbb_search_common_test_case
{
	protected $db;

	/**
	 *
	 * @return unknown
	 */
	public function getDataSet() {
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/empty.xml');
	}


	/**
	 *
	 */
	protected function setUp(): void
	{
		global $phpbb_root_path, $phpEx, $config, $user, $cache;

		parent::setUp();

		// dbal uses cache
		$cache = new phpbb_mock_cache();

		//  set config values
		$config['fulltext_postgres_min_word_len'] = 4;
		$config['fulltext_postgres_max_word_len'] = 254;

		$this->db = $this->new_dbal();
		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$error = null;
		$class = self::get_search_wrapper('\phpbb\search\fulltext_postgres');
		$this->search = new $class($error, $phpbb_root_path, $phpEx, null, $config, $this->db, $user, $phpbb_dispatcher);
	}


}
