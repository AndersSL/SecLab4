<?php

namespace vendor2\foo;

class ext extends \phpbb\extension\base
{
	static public $disabled;

	/**
	 *
	 * @param unknown $old_state
	 * @return unknown
	 */


	public function disable_step($old_state) {
		self::$disabled = true;

		return false;
	}


}
