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


class phpbb_mock_request implements \phpbb\request\request_interface
{
	protected $data;

	protected $super_globals_disabled = false;

	/**
	 *
	 * @param unknown $get     (optional)
	 * @param unknown $post    (optional)
	 * @param unknown $cookie  (optional)
	 * @param unknown $server  (optional)
	 * @param unknown $request (optional)
	 * @param unknown $files   (optional)
	 */
	public function __construct($get = array(), $post = array(), $cookie = array(), $server = array(), $request = false, $files = array()) {
		$this->data[\phpbb\request\request_interface::GET] = $get;
		$this->data[\phpbb\request\request_interface::POST] = $post;
		$this->data[\phpbb\request\request_interface::COOKIE] = $cookie;
		$this->data[\phpbb\request\request_interface::REQUEST] = ($request === false) ? $post + $get : $request;
		$this->data[\phpbb\request\request_interface::SERVER] = $server;
		$this->data[\phpbb\request\request_interface::FILES] = $files;

		$this->disable_super_globals();
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $value
	 * @param unknown $super_global (optional)
	 */
	public function overwrite($var_name, $value, $super_global = \phpbb\request\request_interface::REQUEST) {
		$this->data[$super_global][$var_name] = $value;
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $default
	 * @param unknown $super_global (optional)
	 * @return unknown
	 */
	public function raw_variable($var_name, $default, $super_global = \phpbb\request\request_interface::REQUEST) {
		return $this->variable($var_name, $default, true, $super_global);
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $default
	 * @param unknown $multibyte    (optional)
	 * @param unknown $super_global (optional)
	 * @return unknown
	 */
	public function variable($var_name, $default, $multibyte = false, $super_global = \phpbb\request\request_interface::REQUEST) {
		return isset($this->data[$super_global][$var_name]) ? $this->data[$super_global][$var_name] : $default;
	}


	/**
	 *
	 * @param unknown $var_name
	 * @param unknown $default  (optional)
	 * @return unknown
	 */
	public function server($var_name, $default = '') {
		$super_global = \phpbb\request\request_interface::SERVER;
		return isset($this->data[$super_global][$var_name]) ? $this->data[$super_global][$var_name] : $default;
	}


	/**
	 *
	 * @param unknown $header_name
	 * @param unknown $default     (optional)
	 * @return unknown
	 */
	public function header($header_name, $default = '') {
		$var_name = 'HTTP_' . str_replace('-', '_', strtoupper($header_name));
		return $this->server($var_name, $default);
	}


	/**
	 *
	 * @param unknown $form_name
	 * @return unknown
	 */
	public function file($form_name) {
		$super_global = \phpbb\request\request_interface::FILES;
		return isset($this->data[$super_global][$form_name]) ? $this->data[$super_global][$form_name] : array();
	}


	/**
	 *
	 * @param unknown $name
	 * @return unknown
	 */
	public function is_set_post($name) {
		return $this->is_set($name, \phpbb\request\request_interface::POST);
	}


	/**
	 *
	 * @param unknown $var
	 * @param unknown $super_global (optional)
	 * @return unknown
	 */
	public function is_set($var, $super_global = \phpbb\request\request_interface::REQUEST) {
		return isset($this->data[$super_global][$var]);
	}


	/**
	 *
	 * @return unknown
	 */
	public function is_ajax() {
		return false;
	}


	/**
	 *
	 * @return unknown
	 */
	public function is_secure() {
		return false;
	}


	/**
	 *
	 * @param unknown $super_global (optional)
	 * @return unknown
	 */
	public function variable_names($super_global = \phpbb\request\request_interface::REQUEST) {
		return array_keys($this->data[$super_global]);
	}


	/**
	 *
	 * @param unknown $super_global (optional)
	 * @return unknown
	 */
	public function get_super_global($super_global = \phpbb\request\request_interface::REQUEST) {
		return $this->data[$super_global];
	}


	/**
	 *
	 * @return unknown
	 */
	public function super_globals_disabled() {
		return $this->super_globals_disabled;
	}


	/**
	 *
	 */
	public function disable_super_globals() {
		$this->super_globals_disabled = true;
	}


	/**
	 *
	 */
	public function enable_super_globals() {
		$this->super_globals_disabled = false;
	}


	/* custom methods */

	/**
	 *
	 * @param unknown $header_name
	 * @param unknown $value
	 */
	public function set_header($header_name, $value) {
		$var_name = 'HTTP_' . str_replace('-', '_', strtoupper($header_name));
		$this->data[\phpbb\request\request_interface::SERVER][$var_name] = $value;
	}


	/**
	 *
	 * @param unknown $super_global (optional)
	 * @param unknown $values
	 */
	public function merge($super_global = \phpbb\request\request_interface::REQUEST, $values) {
		$this->data[$super_global] = array_merge($this->data[$super_global], $values);
	}


	/**
	 *
	 * @param unknown $var
	 * @param unknown $multibyte
	 * @return unknown
	 */
	public function escape($var, $multibyte) {
		$type_cast_helper = new \phpbb\request\type_cast_helper();
		if (is_array($var)) {
			$result = array();
			foreach ($var as $key => $value) {
				$type_cast_helper->set_var($key, $key, gettype($key), $multibyte);
				$result[$key] = $this->escape($value, $multibyte);
			}
			$var = $result;
		}
		else {
			$type_cast_helper->set_var($var, $var, 'string', $multibyte);
		}

		return $var;
	}


}
