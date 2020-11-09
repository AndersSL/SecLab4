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


namespace phpbb\storage\provider;

class local implements provider_interface
{

	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_name() {
		return 'local';
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_adapter_class() {
		return \phpbb\storage\adapter\local::class;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_options() {
		return [
			'path' => ['type' => 'text'],
			'subfolders' => [
				'type' => 'radio',
				'options' => [
					'ENABLE' => '1',
					'DISABLE' => '0',
				],
			],
		];
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_available() {
		return true;
	}


}
