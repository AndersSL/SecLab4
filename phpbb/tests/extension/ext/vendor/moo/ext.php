<?php

namespace vendor\moo;

class ext extends \phpbb\extension\base
{
	static public $purged;

	/**
	 *
	 * @param unknown $old_state
	 * @return unknown
	 */


	public function purge_step($old_state) {
		self::$purged = true;

		return false;
	}


}
