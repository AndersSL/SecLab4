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


namespace phpbb\db\extractor;

/**
 * Database extractor interface
 */
interface extractor_interface
{

	/**
	 * Start the extraction of the database
	 *
	 * This function initialize the database extraction. It is required to call this
	 * function before calling any other extractor functions.
	 *
	 * @throws \phpbb\db\extractor\exception\invalid_format_exception when $format is invalid
	 * @param string  $format
	 * @param string  $filename
	 * @param int     $time
	 * @param bool    $download (optional)
	 * @param bool    $store    (optional)
	 * @return null
	 */
	public function init_extractor($format, $filename, $time, $download = false, $store = false);

	/**
	 * Writes header comments to the database backup
	 *
	 * @throws \phpbb\db\extractor\exception\extractor_not_initialized_exception when calling this function before init_extractor()
	 * @param string  $table_prefix prefix of phpBB database tables
	 * @return null
	 */
	public function write_start($table_prefix);

	/**
	 * Closes file and/or dumps download data
	 *
	 * @throws \phpbb\db\extractor\exception\extractor_not_initialized_exception when calling this function before init_extractor()
	 * @return null
	 */
	public function write_end();

	/**
	 * Extracts database table structure
	 *
	 * @throws \phpbb\db\extractor\exception\extractor_not_initialized_exception when calling this function before init_extractor()
	 * @param string  $table_name name of the database table
	 * @return null
	 */
	public function write_table($table_name);

	/**
	 * Extracts data from database table
	 *
	 * @throws \phpbb\db\extractor\exception\extractor_not_initialized_exception when calling this function before init_extractor()
	 * @param string  $table_name name of the database table
	 * @return null
	 */
	public function write_data($table_name);

	/**
	 * Writes data to file/download content
	 *
	 * @throws \phpbb\db\extractor\exception\extractor_not_initialized_exception when calling this function before init_extractor()
	 * @param string  $data
	 * @return null
	 */
	public function flush($data);
}
