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

use \Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Database Abstraction Layer
 */
class factory implements driver_interface
{

	/**
	 *
	 * @var driver_interface
	 */
	protected $driver = null;

	/**
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container A ContainerInterface instance
	 */
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}


	/**
	 * Return the current driver (and retrieved it from the container if necessary)
	 *
	 * @return driver_interface
	 */
	protected function get_driver() {
		if ($this->driver === null) {
			$this->driver = $this->container->get('dbal.conn.driver');
		}

		return $this->driver;
	}


	/**
	 * Set the current driver
	 *
	 * @param driver_interface $driver
	 */
	public function set_driver(driver_interface $driver) {
		$this->driver = $driver;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $value
	 */
	public function set_debug_load_time($value) {
		$this->get_driver()->set_debug_load_time($value);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $value
	 */
	public function set_debug_sql_explain($value) {
		$this->get_driver()->set_debug_sql_explain($value);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_sql_layer() {
		return $this->get_driver()->get_sql_layer();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_db_name() {
		return $this->get_driver()->get_db_name();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_any_char() {
		return $this->get_driver()->get_any_char();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_one_char() {
		return $this->get_driver()->get_one_char();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_db_connect_id() {
		return $this->get_driver()->get_db_connect_id();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_sql_error_triggered() {
		return $this->get_driver()->get_sql_error_triggered();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_sql_error_sql() {
		return $this->get_driver()->get_sql_error_sql();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_transaction() {
		return $this->get_driver()->get_transaction();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_sql_time() {
		return $this->get_driver()->get_sql_time();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_sql_error_returned() {
		return $this->get_driver()->get_sql_error_returned();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_multi_insert() {
		return $this->get_driver()->get_multi_insert();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $multi_insert
	 */
	public function set_multi_insert($multi_insert) {
		$this->get_driver()->set_multi_insert($multi_insert);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $table_name
	 * @return unknown
	 */
	public function get_row_count($table_name) {
		return $this->get_driver()->get_row_count($table_name);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $table_name
	 * @return unknown
	 */
	public function get_estimated_row_count($table_name) {
		return $this->get_driver()->get_estimated_row_count($table_name);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $column_name
	 * @return unknown
	 */
	public function sql_lower_text($column_name) {
		return $this->get_driver()->sql_lower_text($column_name);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $sql (optional)
	 * @return unknown
	 */
	public function sql_error($sql = '') {
		return $this->get_driver()->sql_error($sql);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function sql_buffer_nested_transactions() {
		return $this->get_driver()->sql_buffer_nested_transactions();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $column_name
	 * @param unknown $bit
	 * @param unknown $compare     (optional)
	 * @return unknown
	 */
	public function sql_bit_or($column_name, $bit, $compare = '') {
		return $this->get_driver()->sql_bit_or($column_name, $bit, $compare);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $raw       (optional)
	 * @param unknown $use_cache (optional)
	 * @return unknown
	 */
	public function sql_server_info($raw = false, $use_cache = true) {
		return $this->get_driver()->sql_server_info($raw, $use_cache);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $fail (optional)
	 * @return unknown
	 */
	public function sql_return_on_error($fail = false) {
		return $this->get_driver()->sql_return_on_error($fail);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query
	 * @param unknown $assoc_ary (optional)
	 * @return unknown
	 */
	public function sql_build_array($query, $assoc_ary = array()) {
		return $this->get_driver()->sql_build_array($query, $assoc_ary);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query_id (optional)
	 * @return unknown
	 */
	public function sql_fetchrowset($query_id = false) {
		return $this->get_driver()->sql_fetchrowset($query_id);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $status (optional)
	 * @return unknown
	 */
	public function sql_transaction($status = 'begin') {
		return $this->get_driver()->sql_transaction($status);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $expr1
	 * @param unknown $expr2
	 * @return unknown
	 */
	public function sql_concatenate($expr1, $expr2) {
		return $this->get_driver()->sql_concatenate($expr1, $expr2);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $condition
	 * @param unknown $action_true
	 * @param unknown $action_false (optional)
	 * @return unknown
	 */
	public function sql_case($condition, $action_true, $action_false = false) {
		return $this->get_driver()->sql_case($condition, $action_true, $action_false);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query
	 * @param unknown $array
	 * @return unknown
	 */
	public function sql_build_query($query, $array) {
		return $this->get_driver()->sql_build_query($query, $array);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $field
	 * @param unknown $rownum   (optional)
	 * @param unknown $query_id (optional)
	 * @return unknown
	 */
	public function sql_fetchfield($field, $rownum = false, $query_id = false) {
		return $this->get_driver()->sql_fetchfield($field, $rownum, $query_id);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query_id (optional)
	 * @return unknown
	 */
	public function sql_fetchrow($query_id = false) {
		return $this->get_driver()->sql_fetchrow($query_id);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $expression
	 * @return unknown
	 */
	public function cast_expr_to_bigint($expression) {
		return $this->get_driver()->cast_expr_to_bigint($expression);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function sql_nextid() {
		return $this->get_driver()->sql_nextid();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $cached (optional)
	 * @return unknown
	 */
	public function sql_add_num_queries($cached = false) {
		return $this->get_driver()->sql_add_num_queries($cached);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query
	 * @param unknown $total
	 * @param unknown $offset    (optional)
	 * @param unknown $cache_ttl (optional)
	 * @return unknown
	 */
	public function sql_query_limit($query, $total, $offset = 0, $cache_ttl = 0) {
		return $this->get_driver()->sql_query_limit($query, $total, $offset, $cache_ttl);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query     (optional)
	 * @param unknown $cache_ttl (optional)
	 * @return unknown
	 */
	public function sql_query($query = '', $cache_ttl = 0) {
		return $this->get_driver()->sql_query($query, $cache_ttl);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $expression
	 * @return unknown
	 */
	public function cast_expr_to_string($expression) {
		return $this->get_driver()->cast_expr_to_string($expression);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $sqlserver
	 * @param unknown $sqluser
	 * @param unknown $sqlpassword
	 * @param unknown $database
	 * @param unknown $port        (optional)
	 * @param unknown $persistency (optional)
	 * @param unknown $new_link    (optional)
	 */
	public function sql_connect($sqlserver, $sqluser, $sqlpassword, $database, $port = false, $persistency = false, $new_link = false) {
		throw new \Exception('Disabled method.');
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $column_name
	 * @param unknown $bit
	 * @param unknown $compare     (optional)
	 * @return unknown
	 */
	public function sql_bit_and($column_name, $bit, $compare = '') {
		return $this->get_driver()->sql_bit_and($column_name, $bit, $compare);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $query_id (optional)
	 * @return unknown
	 */
	public function sql_freeresult($query_id = false) {
		return $this->get_driver()->sql_freeresult($query_id);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $cached (optional)
	 * @return unknown
	 */
	public function sql_num_queries($cached = false) {
		return $this->get_driver()->sql_num_queries($cached);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $table
	 * @param unknown $sql_ary
	 * @return unknown
	 */
	public function sql_multi_insert($table, $sql_ary) {
		return $this->get_driver()->sql_multi_insert($table, $sql_ary);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function sql_affectedrows() {
		return $this->get_driver()->sql_affectedrows();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function sql_close() {
		return $this->get_driver()->sql_close();
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $rownum
	 * @param unknown $query_id (reference)
	 * @return unknown
	 */
	public function sql_rowseek($rownum, &$query_id) {
		return $this->get_driver()->sql_rowseek($rownum, $query_id);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $msg
	 * @return unknown
	 */
	public function sql_escape($msg) {
		return $this->get_driver()->sql_escape($msg);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $expression
	 * @return unknown
	 */
	public function sql_like_expression($expression) {
		return $this->get_driver()->sql_like_expression($expression);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $expression
	 * @return unknown
	 */
	public function sql_not_like_expression($expression) {
		return $this->get_driver()->sql_not_like_expression($expression);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $mode
	 * @param unknown $query (optional)
	 * @return unknown
	 */
	public function sql_report($mode, $query = '') {
		return $this->get_driver()->sql_report($mode, $query);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $field
	 * @param unknown $array
	 * @param unknown $negate          (optional)
	 * @param unknown $allow_empty_set (optional)
	 * @return unknown
	 */
	public function sql_in_set($field, $array, $negate = false, $allow_empty_set = false) {
		return $this->get_driver()->sql_in_set($field, $array, $negate, $allow_empty_set);
	}


}
