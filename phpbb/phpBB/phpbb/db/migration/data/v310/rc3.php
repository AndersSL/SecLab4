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

class rc3 extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return phpbb_version_compare($this->config['version'], '3.1.0-RC3', '>=');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v310\rc2',
			'\phpbb\db\migration\data\v310\captcha_plugins',
			'\phpbb\db\migration\data\v310\rename_too_long_indexes',
			'\phpbb\db\migration\data\v310\search_type',
			'\phpbb\db\migration\data\v310\topic_sort_username',
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array(
			array('config.update', array('version', '3.1.0-RC3')),
		);
	}


}
