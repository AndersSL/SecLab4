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


namespace phpbb\mimetype;

class content_guesser extends guesser_base
{

	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function is_supported() {
		return function_exists('mime_content_type') && is_callable('mime_content_type');
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $file
	 * @param unknown $file_name (optional)
	 * @return unknown
	 */
	public function guess($file, $file_name = '') {
		return mime_content_type($file);
	}


}
