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


namespace phpbb\feed\exception;

class no_topic_exception extends feed_unavailable_exception
{

	/**
	 *
	 * @param unknown   $topic_id
	 * @param Exception $previous (optional)
	 * @param unknown   $code     (optional)
	 */
	public function __construct($topic_id, \Exception $previous = null, $code = 0) {
		parent::__construct('NO_TOPIC', array($topic_id), $previous, $code);
	}


}
