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


namespace phpbb\db\driver;

/**
 * MSSQL Database Base Abstraction Layer
 */
abstract class mssql_base extends \phpbb\db\driver\driver
{

	/**
	 * {@inheritDoc}
	 *
	 * @param unknown $expr1
	 * @param unknown $expr2
	 * @return unknown
	 */
	public function sql_concatenate($expr1, $expr2) {
		return $expr1 . ' + ' . $expr2;
	}


	/**
	 * {@inheritDoc}
	 *
	 * @param unknown $msg
	 * @return unknown
	 */
	function sql_escape($msg) {
		return str_replace(array("'", "\0"), array("''", ''), $msg);
	}


	/**
	 * {@inheritDoc}
	 *
	 * @param unknown $column_name
	 * @return unknown
	 */
	function sql_lower_text($column_name) {
		return "LOWER(SUBSTRING($column_name, 1, DATALENGTH($column_name)))";
	}


	/**
	 * Build LIKE expression
	 *
	 * @access private
	 * @param unknown $expression
	 * @return unknown
	 */
	function _sql_like_expression($expression) {
		return $expression . " ESCAPE '\\'";
	}


	/**
	 * Build NOT LIKE expression
	 *
	 * @access private
	 * @param unknown $expression
	 * @return unknown
	 */
	function _sql_not_like_expression($expression) {
		return $expression . " ESCAPE '\\'";
	}


	/**
	 * {@inheritDoc}
	 *
	 * @param unknown $expression
	 * @return unknown
	 */
	function cast_expr_to_bigint($expression) {
		return 'CONVERT(BIGINT, ' . $expression . ')';
	}


	/**
	 * Build db-specific query data
	 *
	 * @access private
	 * @param unknown $stage
	 * @param unknown $data
	 * @return unknown
	 */
	function _sql_custom_build($stage, $data) {
		return $data;
	}


}
