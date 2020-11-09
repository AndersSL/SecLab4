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


namespace phpbb\db\migration\tool;

/**
 * Migration config_text tool
 */
class config_text implements \phpbb\db\migration\tool\tool_interface
{
	/** @var \phpbb\config\db_text */
	protected $config_text;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\db_text $config_text
	 */
	public function __construct(\phpbb\config\db_text $config_text) {
		$this->config_text = $config_text;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_name() {
		return 'config_text';
	}


	/**
	 * Add a config_text setting.
	 *
	 *  you would like to add
	 *
	 * @param string  $config_name  The name of the config_text setting
	 * @param mixed   $config_value The value of the config_text setting
	 * @return null
	 */
	public function add($config_name, $config_value) {
		if (!is_null($this->config_text->get($config_name))) {
			return;
		}

		$this->config_text->set($config_name, $config_value);
	}


	/**
	 * Update an existing config_text setting.
	 *
	 *  like to update
	 *
	 * @throws \phpbb\db\migration\exception
	 * @param string  $config_name  The name of the config_text setting you would
	 * @param mixed   $config_value The value of the config_text setting
	 * @return null
	 */
	public function update($config_name, $config_value) {
		if (is_null($this->config_text->get($config_name))) {
			throw new \phpbb\db\migration\exception('CONFIG_NOT_EXIST', $config_name);
		}

		$this->config_text->set($config_name, $config_value);
	}


	/**
	 * Remove an existing config_text setting.
	 *
	 *  like to remove
	 *
	 * @param string  $config_name The name of the config_text setting you would
	 * @return null
	 */
	public function remove($config_name) {
		if (is_null($this->config_text->get($config_name))) {
			return;
		}

		$this->config_text->delete($config_name);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function reverse() {
		$arguments = func_get_args();
		$original_call = array_shift($arguments);

		$call = false;
		switch ($original_call) {
		case 'add':
			$call = 'remove';
			break;

		case 'remove':
			$call = 'add';
			if (count($arguments) == 1) {
				$arguments[] = '';
			}
			break;

		case 'reverse':
			// Reversing a reverse is just the call itself
			$call = array_shift($arguments);
			break;
		}

		if ($call) {
			return call_user_func_array(array(&$this, $call), $arguments);
		}
	}


}
