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


namespace phpbb\db\migration\data\v400;

use phpbb\db\migration\migration;
use phpbb\storage\provider\local;

class storage_attachment extends migration
{

	/**
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return $this->config->offsetExists('storage\\attachment\\provider');
	}


	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return [
			'\phpbb\db\migration\data\v400\dev',
		];
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return [
			['config.add', ['storage\\attachment\\provider', local::class]],
			['config.add', ['storage\\attachment\\config\\path', $this->config['upload_path']]],
			['config.remove', ['upload_path']],
		];
	}


}
