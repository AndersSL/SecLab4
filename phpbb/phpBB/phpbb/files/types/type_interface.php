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


namespace phpbb\files\types;

use phpbb\files\upload;

interface type_interface
{

	/**
	 * Handle upload for upload types. Arguments passed to this method will be
	 * handled by the upload type classes themselves.
	 *
	 *                                    successful or false if not
	 *
	 * @return \phpbb\files\filespec|bool Filespec instance if upload is
	 */
	public function upload();

	/**
	 * Set upload instance
	 * Needs to be executed before every upload.
	 *
	 *
	 * @param upload  $upload Upload instance
	 * @return type_interface Returns itself
	 */
	public function set_upload(upload $upload);
}
