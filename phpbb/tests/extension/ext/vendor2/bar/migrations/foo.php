<?php

namespace vendor2\foo\migrations;

class foo implements \phpbb\db\migration\migration_interface
{
	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */


	static public function depends_on() {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function effectively_installed() {
		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function update_schema() {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function revert_schema() {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function revert_data() {
		return array();
	}


}
