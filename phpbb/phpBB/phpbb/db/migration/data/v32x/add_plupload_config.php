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

class add_plupload_config extends \phpbb\db\migration\migration
{

	/**
	 *
	 * @return unknown
	 */
	static public function depends_on() {
		return ['\phpbb\db\migration\data\v32x\v329'];
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return [
			['config.add', ['img_quality', '85']],
			['config.add', ['img_strip_metadata', '0']],
		];
	}


}
