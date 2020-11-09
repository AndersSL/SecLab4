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


namespace phpbb\install;

/**
 * Base class for installer task
 */
abstract class task_base implements task_interface
{

	/**
	 *
	 * @var bool
	 */
	protected $is_essential;

	/**
	 * Constructor
	 *
	 * @param bool    $essential (optional)
	 */
	public function __construct($essential = true) {
		$this->is_essential = $essential;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_essential() {
		return $this->is_essential;
	}


	/**
	 * {@inheritdoc}
	 *
	 * Note: Overwrite this method if your task is non-essential!
	 *
	 * @return unknown
	 */
	public function check_requirements() {
		return true;
	}


}
