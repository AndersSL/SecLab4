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

class email_force_sender extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return array(
			'\phpbb\db\migration\data\v32x\v321',
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return isset($this->config['email_force_sender']);
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array(
			array('config.add', array('email_force_sender', '0')),
			array('config.remove', array('email_function_name')),
		);
	}


}
