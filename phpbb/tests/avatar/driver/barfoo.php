<?php

namespace phpbb\avatar\driver;

class barfoo extends \phpbb\avatar\driver\driver
{
	/**
	 *
	 * @param unknown $row
	 * @return unknown
	 */


	public function get_data($row) {
		return array();
	}


	/**
	 *
	 * @param unknown $request
	 * @param unknown $template
	 * @param unknown $user
	 * @param unknown $row
	 * @param unknown $error    (reference)
	 * @return unknown
	 */
	public function prepare_form($request, $template, $user, $row, &$error) {
		return false;
	}


	/**
	 *
	 * @param unknown $request
	 * @param unknown $template
	 * @param unknown $user
	 * @param unknown $row
	 * @param unknown $error    (reference)
	 * @return unknown
	 */
	public function process_form($request, $template, $user, $row, &$error) {
		return false;
	}


	/**
	 *
	 * @return unknown
	 */
	public function get_template_name() {
		return 'barfoo.html';
	}


}
