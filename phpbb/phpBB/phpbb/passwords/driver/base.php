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


namespace phpbb\passwords\driver;

abstract class base implements rehashable_driver_interface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\passwords\driver\helper */
	protected $helper;

	/** @var string Driver name */
	protected $name;

	/**
	 * Constructor of passwords driver object
	 *
	 * @param \phpbb\config\config           $config phpBB config
	 * @param \phpbb\passwords\driver\helper $helper Password driver helper
	 */
	public function __construct(\phpbb\config\config $config, helper $helper) {
		$this->config = $config;
		$this->helper = $helper;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_supported() {
		return true;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_legacy() {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $hash
	 * @return unknown
	 */
	public function needs_rehash($hash) {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $hash
	 * @param unknown $full (optional)
	 * @return unknown
	 */
	public function get_settings_only($hash, $full = false) {
		return false;
	}


}
