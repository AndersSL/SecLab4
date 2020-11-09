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

use phpbb\db\migration\migration;

class v320 extends migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return version_compare($this->config['version'], '3.2.0', '>=');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v31x\increase_size_of_emotion',
			'\phpbb\db\migration\data\v320\cookie_notice',
		);

	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array(
			array('config.update', array('version', '3.2.0')),
		);
	}


}
