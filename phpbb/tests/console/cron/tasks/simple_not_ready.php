<?php

class phpbb_cron_task_simple_not_ready extends \phpbb\cron\task\base
{
	/**
	 *
	 */


	public function run() {
	}


	/**
	 *
	 * @return unknown
	 */
	public function should_run() {
		return false;
	}


}
