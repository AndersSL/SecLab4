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


require_once dirname(__FILE__) . '/common_helper_route.php';

class phpbb_controller_helper_route_slash_test extends phpbb_controller_common_helper_route
{

	/**
	 *
	 * @return unknown
	 */
	protected function get_phpbb_root_path() {
		return './../';
	}


	/**
	 *
	 * @return unknown
	 */
	protected function get_uri() {
		return '/phpBB3/app.php';
	}


	/**
	 *
	 * @return unknown
	 */
	protected function get_base_uri() {
		return '/phpBB3/';
	}


	/**
	 *
	 * @return unknown
	 */
	protected function get_script_name() {
		return 'app.php';
	}


	/**
	 *
	 * @return unknown
	 */
	protected function path_to_app() {
		return 'phpBB3/';
	}


}
