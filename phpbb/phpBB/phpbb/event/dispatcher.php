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


namespace phpbb\event;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

/**
 * Extension of the Symfony EventDispatcher
 *
 * It provides an additional `trigger_event` method, which
 * gives some syntactic sugar for dispatching events. Instead
 * of creating the event object, the method will do that for
 * you.
 *
 * Example:
 *
 *     $vars = array('page_title');
 *     extract($phpbb_dispatcher->trigger_event('core.index', compact($vars)));
 *
 */
class dispatcher extends EventDispatcher implements dispatcher_interface
{

	/**
	 *
	 * @var bool
	 */
	protected $disabled = false;

	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $eventName
	 * @param unknown $data      (optional)
	 * @return unknown
	 */
	public function trigger_event($eventName, $data = []) {
		$event = new \phpbb\event\data($data);
		$this->dispatch($eventName, $event);
		return $event->get_data_filtered(array_keys($data));
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $eventName
	 * @param Event   $event     (optional)
	 * @return unknown
	 */
	public function dispatch($eventName, Event $event = null) {
		if ($this->disabled) {
			return $event;
		}

		foreach ((array) $eventName as $name) {
			$event = parent::dispatch($name, $event);
		}

		return $event;
	}


	/**
	 * {@inheritdoc}
	 */
	public function disable() {
		$this->disabled = true;
	}


	/**
	 * {@inheritdoc}
	 */
	public function enable() {
		$this->disabled = false;
	}


}
