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

class null_guesser {
	protected $is_supported;

	/**
	 *
	 * @param unknown $is_supported (optional)
	 */
	public function __construct($is_supported = true) {
		$this->is_supported = $is_supported;
	}


	/**
	 *
	 * @return unknown
	 */
	public function is_supported() {
		return $this->is_supported;
	}


	/**
	 *
	 * @param unknown $file
	 * @return unknown
	 */
	public function guess($file) {
		return null;
	}


}
