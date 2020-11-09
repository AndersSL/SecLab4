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


namespace phpbb\template\twig\node;

class includejs extends \phpbb\template\twig\node\includeasset
{

	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_setters_name() {
		return 'script';
	}


}
