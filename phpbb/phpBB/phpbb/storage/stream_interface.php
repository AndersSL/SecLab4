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


namespace phpbb\storage;

interface stream_interface
{

	/**
	 * Reads a file as a stream
	 *
	 *
	 * @throws \phpbb\storage\exception\exception  When unable to open file
	 *
	 * @param string  $path File to read
	 * @return resource Returns a file pointer
	 */
	public function read_stream($path);

	/**
	 * Writes a new file using a stream
	 *
	 *
	 * @throws \phpbb\storage\exception\exception  When target file exists
	 *              When target file cannot be created
	 * @param string   $path     The target file
	 * @param resource $resource The resource
	 */
	public function write_stream($path, $resource);
}
