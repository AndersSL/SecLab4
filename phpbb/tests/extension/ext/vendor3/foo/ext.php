<?php

namespace vendor3\foo;

class ext extends \phpbb\extension\base
{
	static public $enabled;

	/**
	 *
	 * @param unknown $old_state
	 * @return unknown
	 */


	public function enable_step($old_state) {
		self::$enabled = true;

		return self::$enabled;
	}


	/**
	 *
	 * @return unknown
	 */
	public function is_enableable() {
		return false;
	}


}
