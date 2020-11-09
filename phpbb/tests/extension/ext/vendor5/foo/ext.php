<?php

namespace vendor5\foo;

class ext extends \phpbb\extension\base
{
	static public $enabled;

	/**
	 *
	 * @return unknown
	 */


	public function is_enableable() {
		return array('Reason 1', 'Reason 2');
	}


	/**
	 *
	 * @param unknown $old_state
	 * @return unknown
	 */
	public function enable_step($old_state) {
		self::$enabled = true;
		return self::$enabled;
	}


}
