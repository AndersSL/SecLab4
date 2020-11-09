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


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ScopeInterface;

class phpbb_mock_container_builder implements ContainerInterface
{
	protected $services = array();
	protected $parameters = array();

	/**
	 *
	 */
	public function __construct() {
		$this->setParameter('debug.load_time', false);
		$this->setParameter('session.log_errors', false);
	}


	/**
	 * Sets a service.
	 *
	 *
	 * @api
	 * @param string  $id      The service identifier
	 * @param object  $service The service instance
	 * @param bool    $shared  (optional) Whether service is shared
	 */
	public function set($id, $service, $shared = false) {
		$this->services[$id] = $service;
	}


	/**
	 * Gets a service.
	 *
	 *
	 *
	 * @throws InvalidArgumentException if the service is not defined
	 * @throws ServiceCircularReferenceException When a circular reference is detected
	 * @throws ServiceNotFoundException When the service is not defined
	 *
	 *
	 * @api
	 * @see Reference
	 * @param string  $id              The service identifier
	 * @param int     $invalidBehavior (optional) The behavior when the service does not exist
	 * @return object The associated service
	 */
	public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE) {
		if ($this->has($id)) {
			$service = $this->services[$id];
			if (is_array($service) && is_callable($service[0])) {
				return call_user_func_array($service[0], $service[1]);
			}
			else {
				return $service;
			}
		}

		throw new Exception('Could not find service: ' . $id);
	}


	/**
	 * Returns true if the given service is defined.
	 *
	 *
	 *
	 * @api
	 * @param string  $id The service identifier
	 * @return Boolean true if the service is defined, false otherwise
	 */
	public function has($id) {
		return isset($this->services[$id]);
	}


	/**
	 * Gets a parameter.
	 *
	 *
	 *
	 * @throws InvalidArgumentException if the parameter is not defined
	 *
	 * @api
	 * @param string  $name The parameter name
	 * @return mixed  The parameter value
	 */
	public function getParameter($name) {
		if ($this->hasParameter($name)) {
			return $this->parameters[$name];
		}

		throw new Exception('Could not find parameter: ' . $name);
	}


	/**
	 * Checks if a parameter exists.
	 *
	 *
	 *
	 * @api
	 * @param string  $name The parameter name
	 * @return Boolean The presence of parameter in container
	 */
	public function hasParameter($name) {
		return isset($this->parameters[$name]);
	}


	/**
	 * Sets a parameter.
	 *
	 *
	 * @api
	 * @param string  $name  The parameter name
	 * @param mixed   $value The parameter value
	 */
	public function setParameter($name, $value) {
		$this->parameters[$name] = $value;
	}


	/**
	 * Enters the given scope
	 *
	 *
	 * @api
	 * @param string  $name
	 */
	public function enterScope($name) {
	}


	/**
	 * Leaves the current scope, and re-enters the parent scope
	 *
	 *
	 * @api
	 * @param string  $name
	 */
	public function leaveScope($name) {
	}


	/**
	 * Adds a scope to the container
	 *
	 *
	 * @api
	 * @param ScopeInterface $scope
	 */
	public function addScope(ScopeInterface $scope) {
	}


	/**
	 * Whether this container has the given scope
	 *
	 *
	 *
	 * @api
	 * @param string  $name
	 * @return Boolean
	 */
	public function hasScope($name) {
	}


	/**
	 * Determines whether the given scope is currently active.
	 *
	 * It does however not check if the scope actually exists.
	 *
	 *
	 *
	 * @api
	 * @param string  $name
	 * @return Boolean
	 */
	public function isScopeActive($name) {
	}


	/**
	 *
	 * @return unknown
	 */
	public function isFrozen() {
		return false;
	}


	/**
	 *
	 * @param unknown $id
	 * @return unknown
	 */
	public function initialized($id) {
		return true;
	}


}
