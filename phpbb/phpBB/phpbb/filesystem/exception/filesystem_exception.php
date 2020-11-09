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


namespace phpbb\filesystem\exception;

use phpbb\exception\runtime_exception;

class filesystem_exception extends runtime_exception
{

	/**
	 * Constructor
	 *
	 * @param string          $message    (optional) The Exception message to throw (must be a language variable).
	 * @param string          $filename   (optional) The file that caused the error.
	 * @param array           $parameters (optional) The parameters to use with the language var.
	 * @param \Exception|null $previous   The previous runtime_exception used for the runtime_exception chaining.
	 * @param integer         $code       (optional) The Exception code.
	 */
	public function __construct($message = '', $filename = '', $parameters = array(), \Exception $previous = null, $code = 0) {
		parent::__construct($message, array_merge(array('filename' => $filename), $parameters), $previous, $code);
	}


	/**
	 * Returns the filename that triggered the error
	 *
	 * @return string
	 */
	public function get_filename() {
		$parameters = $this->get_parameters();
		return $parameters['filename'];
	}


}