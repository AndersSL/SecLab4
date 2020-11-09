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


namespace phpbb\db\output_handler;

class html_migrator_output_handler implements migrator_output_handler_interface
{

	/**
	 * Language object.
	 *
	 * @var \phpbb\language\language
	 */
	private $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language $language Language object
	 */
	public function __construct(\phpbb\language\language $language) {
		$this->language = $language;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $message
	 * @param unknown $verbosity
	 */
	public function write($message, $verbosity) {
		if ($verbosity <= migrator_output_handler_interface::VERBOSITY_VERBOSE) {
			$final_message = $this->language->lang_array(array_shift($message), $message);
			echo $final_message . "<br />\n";
		}
	}


}
