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


/**
 * Mock filespec class with some basic values to help with testing the
 * fileupload class
 */
class phpbb_mock_filespec {
	public $filesize;
	public $realname;
	public $extension;
	public $width;
	public $height;
	public $error = array();

	/**
	 *
	 * @param unknown $disallowed_content
	 * @return unknown
	 */
	public function check_content($disallowed_content) {
		return true;
	}


	/**
	 *
	 * @param unknown $property
	 * @return unknown
	 */
	public function get($property) {
		return $this->$property;
	}


}
