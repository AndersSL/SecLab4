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


namespace phpbb\install\module\requirements;

class install_module extends abstract_requirements_module
{

	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_navigation_stage_path() {
		return array('install', 0, 'requirements');
	}


}
