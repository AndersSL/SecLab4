<?php

namespace vendor3\bar;

class ext extends \phpbb\extension\base
{
	static public $state;

	/**
	 *
	 * @param unknown $old_state
	 * @return unknown
	 */


	public function enable_step($old_state) {
		// run 4 steps, then quit
		if ($old_state === 4) {
			return false;
		}

		if ($old_state === false) {
			$old_state = 0;
		}

		self::$state = ++$old_state;

		return self::$state;
	}


}
