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


class test_installer_task_mock extends \phpbb\install\task_base
{
	private $task_was_runned;

	/**
	 *
	 */
	public function __construct() {
		$this->task_was_runned = false;

		parent::__construct();
	}


	/**
	 *
	 */
	public function run() {
		$this->task_was_runned = true;
	}


	/**
	 *
	 * @return unknown
	 */
	public function was_task_runned() {
		return $this->task_was_runned;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_task_lang_name() {
		return '';
	}


	/**
	 *
	 * @return unknown
	 */
	public static function get_step_count() {
		return 2;
	}


}
