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


namespace phpbb\search\sphinx;

/**
 * \phpbb\search\sphinx\config_variable
 * Represents a single variable inside the sphinx configuration
 */
class config_variable {
	private $name;
	private $value;
	private $comment;


	/**
	 * Constructs a new variable object
	 *
	 *        config file
	 *
	 * @access public
	 * @param string  $name    Name of the variable
	 * @param string  $value   Value of the variable
	 * @param string  $comment Optional comment after the variable in the
	 */
	function __construct($name, $value, $comment) {
		$this->name = $name;
		$this->value = $value;
		$this->comment = $comment;
	}


	/**
	 * Getter for the variable's name
	 *
	 *
	 * @access public
	 * @return string The variable object's name
	 */
	function get_name() {
		return $this->name;
	}


	/**
	 * Allows changing the variable's value
	 *
	 *
	 * @access public
	 * @param string  $value New value for this variable
	 */
	function set_value($value) {
		$this->value = $value;
	}


	/**
	 * Turns this object into a string readable by sphinx
	 *
	 *
	 * @access public
	 * @return string Config data in textual form
	 */
	function to_string() {
		return "\t" . $this->name . ' = ' . str_replace("\n", " \\\n", $this->value) . ' ' . $this->comment . "\n";
	}


}
