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

interface driver_interface
{

	/**
	 * Set value for load_time debug parameter
	 *
	 * @param bool    $value
	 */
	public function set_debug_load_time($value);

	/**
	 * Set value for sql_explain debug parameter
	 *
	 * @param bool    $value
	 */
	public function set_debug_sql_explain($value);

	/**
	 * Gets the name of the sql layer.
	 *
	 * @return string
	 */
	public function get_sql_layer();

	/**
	 * Gets the name of the database.
	 *
	 * @return string
	 */
	public function get_db_name();

	/**
	 * Wildcards for matching any (%) character within LIKE expressions
	 *
	 * @return string
	 */
	public function get_any_char();

	/**
	 * Wildcards for matching exactly one (_) character within LIKE expressions
	 *
	 * @return string
	 */
	public function get_one_char();

	/**
	 * Gets the time spent into the queries
	 *
	 * @return int
	 */
	public function get_sql_time();

	/**
	 * Gets the connect ID.
	 *
	 * @return mixed
	 */
	public function get_db_connect_id();

	/**
	 * Indicates if an error was triggered.
	 *
	 * @return bool
	 */
	public function get_sql_error_triggered();

	/**
	 * Gets the last faulty query
	 *
	 * @return string
	 */
	public function get_sql_error_sql();

	/**
	 * Indicates if we are in a transaction.
	 *
	 * @return bool
	 */
	public function get_transaction();

	/**
	 * Gets the returned error.
	 *
	 * @return array
	 */
	public function get_sql_error_returned();

	/**
	 * Indicates if multiple insertion can be used
	 *
	 * @return bool
	 */
	public function get_multi_insert();

	/**
	 * Set if multiple insertion can be used
	 *
	 * @param bool    $multi_insert
	 */
	public function set_multi_insert($multi_insert);

	/**
	 * Gets the exact number of rows in a specified table.
	 *
	 * @param string  $table_name Table name
	 * @return string Exact number of rows in $table_name.
	 */
	public function get_row_count($table_name);

	/**
	 * Gets the estimated number of rows in a specified table.
	 *
	 *     Prefixed with ~ if estimated (otherwise exact).
	 *
	 * @param string  $table_name Table name
	 * @return string Number of rows in $table_name.
	 */
	public function get_estimated_row_count($table_name);

	/**
	 * Run LOWER() on DB column of type text (i.e. neither varchar nor char).
	 *
	 * @param string  $column_name The column name to use
	 * @return string  A SQL statement like "LOWER($column_name)"
	 */
	public function sql_lower_text($column_name);

	/**
	 * Display sql error page
	 *
	 *     is set, null otherwise
	 *
	 * @param string  $sql (optional) The SQL query causing the error
	 * @return mixed  Returns the full error message, if $this->return_on_error
	 */
	public function sql_error($sql = '');

	/**
	 * Returns whether results of a query need to be buffered to run a
	 * transaction while iterating over them.
	 *
	 * @return bool Whether buffering is required.
	 */
	public function sql_buffer_nested_transactions();

	/**
	 * Run binary OR operator on DB column.
	 *
	 *     will be converted to (1 << $bit). Is used by options,
	 *     using the number schema... 0, 1, 2...29
	 *
	 * @param string  $column_name The column name to use
	 * @param int     $bit         The value to use for the OR operator,
	 * @param string  $compare     (optional) Any custom SQL code after the check (e.g. "= 0")
	 * @return string A SQL statement like "$column | (1 << $bit) {$compare}"
	 */
	public function sql_bit_or($column_name, $bit, $compare = '');

	/**
	 * Version information about used database
	 *
	 * @param bool    $raw       (optional) Only return the fetched sql_server_version
	 * @param bool    $use_cache (optional) Is it safe to retrieve the value from the cache
	 * @return string sql server version
	 */
	public function sql_server_info($raw = false, $use_cache = true);

	/**
	 * Return on error or display error message
	 *
	 * @param bool    $fail (optional) Should we return on errors, or stop
	 * @return null
	 */
	public function sql_return_on_error($fail = false);

	/**
	 * Build sql statement from an array
	 *
	 *      INSERT, INSERT_SELECT, UPDATE, SELECT, DELETE
	 *
	 * @param string  $query     Should be on of the following strings:
	 * @param array   $assoc_ary (optional) Array with "column => value" pairs
	 * @return string  A SQL statement like "c1 = 'a' AND c2 = 'b'"
	 */
	public function sql_build_array($query, $assoc_ary = array());

	/**
	 * Fetch all rows
	 *
	 *        if false, the last query will be used.
	 *
	 * @param mixed   $query_id (optional) Already executed query to get the rows from,
	 * @return mixed  Nested array if the query had rows, false otherwise
	 */
	public function sql_fetchrowset($query_id = false);

	/**
	 * SQL Transaction
	 *
	 *        begin, commit, rollback
	 *
	 * @param string  $status (optional) Should be one of the following strings:
	 * @return mixed Buffered, seekable result handle, false on error
	 */
	public function sql_transaction($status = 'begin');

	/**
	 * Build a concatenated expression
	 *
	 * @param string  $expr1 Base SQL expression where we append the second one
	 * @param string  $expr2 SQL expression that is appended to the first expression
	 * @return string  Concatenated string
	 */
	public function sql_concatenate($expr1, $expr2);

	/**
	 * Build a case expression
	 *
	 * Note: The two statements action_true and action_false must have the same
	 * data type (int, vchar, ...) in the database!
	 *
	 *       to use action_true rather then action_else
	 *
	 * @param string  $condition    The condition which must be true,
	 * @param string  $action_true  SQL expression that is used, if the condition is true
	 * @param mixed   $action_false (optional) SQL expression that is used, if the condition is false
	 * @return string  CASE expression including the condition and statements
	 */
	public function sql_case($condition, $action_true, $action_false = false);

	/**
	 * Build sql statement from array for select and select distinct statements
	 *
	 * Possible query values: SELECT, SELECT_DISTINCT
	 *
	 *     SELECT  A comma imploded list of columns to select
	 *     FROM  Array with "table => alias" pairs,
	 *        (alias can also be an array)
	 *  Optional: LEFT_JOIN Array of join entries:
	 *      FROM  Table that should be joined
	 *      ON   Condition for the join
	 *  Optional: WHERE  Where SQL statement
	 *  Optional: GROUP_BY Group by SQL statement
	 *  Optional: ORDER_BY Order by SQL statement
	 *
	 * @param string  $query Should be one of: SELECT, SELECT_DISTINCT
	 * @param array   $array Array with the query data:
	 * @return string  A SQL statement ready for execution
	 */
	public function sql_build_query($query, $array);

	/**
	 * Fetch field
	 * if rownum is false, the current row is used, else it is pointing to the row (zero-based)
	 *
	 *        and the row curser will point to the next row
	 *        Note: $rownum is 0 based
	 *        if false, the last query will be used.
	 *
	 *      false, if the row does not exist
	 *
	 * @param string  $field    Name of the column
	 * @param mixed   $rownum   (optional) Row number, if false the current row will be used
	 * @param mixed   $query_id (optional) Already executed query to get the rows from,
	 * @return mixed  String value of the field in the selected row,
	 */
	public function sql_fetchfield($field, $rownum = false, $query_id = false);

	/**
	 * Fetch current row
	 *
	 *        if false, the last query will be used.
	 *
	 *      false, if the row does not exist
	 *
	 * @param mixed   $query_id (optional) Already executed query to get the rows from,
	 * @return mixed  Array with the current row,
	 */
	public function sql_fetchrow($query_id = false);

	/**
	 * Returns SQL string to cast a string expression to an int.
	 *
	 * @param string  $expression An expression evaluating to string
	 * @return string             Expression returning an int
	 */
	public function cast_expr_to_bigint($expression);

	/**
	 * Get last inserted id after insert statement
	 *
	 * @return string  Autoincrement value of the last inserted row
	 */
	public function sql_nextid();

	/**
	 * Add to query count
	 *
	 * @param bool    $cached (optional) Is this query cached?
	 * @return null
	 */
	public function sql_add_num_queries($cached = false);

	/**
	 * Build LIMIT query
	 *
	 *    the time in seconds which the result shall be kept in cache
	 *
	 * @param string  $query     The SQL query to execute
	 * @param int     $total     The number of rows to select
	 * @param int     $offset    (optional)
	 * @param int     $cache_ttl (optional) Either 0 to avoid caching or
	 * @return mixed Buffered, seekable result handle, false on error
	 */
	public function sql_query_limit($query, $total, $offset = 0, $cache_ttl = 0);

	/**
	 * Base query method
	 *
	 *    the time in seconds which the result shall be kept in cache
	 *
	 * @param string  $query     (optional) The SQL query to execute
	 * @param int     $cache_ttl (optional) Either 0 to avoid caching or
	 * @return mixed Buffered, seekable result handle, false on error
	 */
	public function sql_query($query = '', $cache_ttl = 0);

	/**
	 * Returns SQL string to cast an integer expression to a string.
	 *
	 * @param string  $expression An expression evaluating to int
	 * @return string  Expression returning a string
	 */
	public function cast_expr_to_string($expression);

	/**
	 * Connect to server
	 *
	 * @param string  $sqlserver   Address of the database server
	 * @param string  $sqluser     User name of the SQL user
	 * @param string  $sqlpassword Password of the SQL user
	 * @param string  $database    Name of the database
	 * @param mixed   $port        (optional) Port of the database server
	 * @param bool    $persistency (optional)
	 * @param bool    $new_link    (optional) Should a new connection be established
	 * @return mixed Connection ID on success, string error message otherwise
	 */
	public function sql_connect($sqlserver, $sqluser, $sqlpassword, $database, $port = false, $persistency = false, $new_link = false);

	/**
	 * Run binary AND operator on DB column.
	 * Results in sql statement: "{$column_name} & (1 << {$bit}) {$compare}"
	 *
	 *        will be converted to (1 << $bit). Is used by
	 *        options, using the number schema: 0, 1, 2...29
	 *
	 * @param string  $column_name The column name to use
	 * @param int     $bit         The value to use for the AND operator,
	 * @param string  $compare     (optional) Any custom SQL code after the check (for example "= 0")
	 * @return string A SQL statement like: "{$column} & (1 << {$bit}) {$compare}"
	 */
	public function sql_bit_and($column_name, $bit, $compare = '');

	/**
	 * Free sql result
	 *
	 *        if false, the last query will be used.
	 *
	 * @param mixed   $query_id (optional) Already executed query result,
	 * @return null
	 */
	public function sql_freeresult($query_id = false);

	/**
	 * Return number of sql queries and cached sql queries used
	 *
	 * @param bool    $cached (optional) Should we return the number of cached or normal queries?
	 * @return int  Number of queries that have been executed
	 */
	public function sql_num_queries($cached = false);

	/**
	 * Run more than one insert statement.
	 *
	 * @param string  $table   Table name to run the statements on
	 * @param array   $sql_ary Multi-dimensional array holding the statement data
	 * @return bool  false if no statements were executed.
	 */
	public function sql_multi_insert($table, $sql_ary);

	/**
	 * Return number of affected rows
	 *
	 *      false if no query has been run before
	 *
	 * @return mixed  Number of the affected rows by the last query
	 */
	public function sql_affectedrows();

	/**
	 * DBAL garbage collection, close SQL connection
	 *
	 *      Server response otherwise
	 *
	 * @return mixed  False if no connection was opened before,
	 */
	public function sql_close();

	/**
	 * Seek to given row number
	 *
	 *        Note: $rownum is 0 based
	 *        if false, the last query will be used.
	 *        $query_id will then be set correctly
	 *
	 * @param mixed   $rownum   Row number the curser should point to
	 * @param mixed   $query_id (reference) ID of the query to set the row cursor on
	 * @return bool  False if something went wrong
	 */
	public function sql_rowseek($rownum, &$query_id);

	/**
	 * Escape string used in sql query
	 *
	 * @param string  $msg String to be escaped
	 * @return string  Escaped version of $msg
	 */
	public function sql_escape($msg);

	/**
	 * Correctly adjust LIKE expression for special characters
	 * Some DBMS are handling them in a different way
	 *
	 *      escaped, except $this->any_char and $this->one_char
	 *
	 * @param string  $expression The expression to use. Every wildcard is
	 * @return string A SQL statement like: "LIKE 'bertie_%'"
	 */
	public function sql_like_expression($expression);

	/**
	 * Correctly adjust NOT LIKE expression for special characters
	 * Some DBMS are handling them in a different way
	 *
	 *      escaped, except $this->any_char and $this->one_char
	 *
	 * @param string  $expression The expression to use. Every wildcard is
	 * @return string A SQL statement like: "NOT LIKE 'bertie_%'"
	 */
	public function sql_not_like_expression($expression);

	/**
	 * Explain queries
	 *
	 *        add_select_row, fromcache, record_fromcache
	 *
	 * @param string  $mode  Available modes: display, start, stop,
	 * @param string  $query (optional) The Query that should be explained
	 * @return mixed  Either a full HTML page, boolean or null
	 */
	public function sql_report($mode, $query = '');

	/**
	 * Build IN or NOT IN sql comparison string, uses <> or = on single element
	 * arrays to improve comparison speed
	 *
	 *        this function will return 1=1 or 1=0 then.
	 *
	 * @param string  $field           Name of the sql column that shall be compared
	 * @param array   $array           Array of values that are (not) allowed
	 * @param bool    $negate          (optional) true for NOT IN (), false for IN ()
	 * @param bool    $allow_empty_set (optional) If true, allow $array to be empty,
	 * @return string A SQL statement like: "IN (1, 2, 3, 4)" or "= 1"
	 */
	public function sql_in_set($field, $array, $negate = false, $allow_empty_set = false);
}
