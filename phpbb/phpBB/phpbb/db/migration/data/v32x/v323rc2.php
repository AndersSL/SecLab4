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


namespace phpbb\db\migration\data\v32x;

class v323rc2 extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return phpbb_version_compare($this->config['version'], '3.2.3-RC2', '>=');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v32x\v323rc1',
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array(
			array('config.update', array('version', '3.2.3-RC2')),
		);
	}


}
