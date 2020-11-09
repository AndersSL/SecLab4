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


class phpbb_profilefield_type_date_test extends phpbb_test_case
{
	protected $cp;
	protected $field_options;
	protected $user;

	/**
	 * Sets up basic test objects
	 *
	 * @access protected
	 */
	protected function setUp(): void
	{
		$this->user = $this->createMock('\phpbb\user');
		$this->user->expects($this->any())
		->method('lang')
		->will($this->returnCallback(array($this, 'return_callback_implode')));

		$this->user->expects($this->any())
		->method('create_datetime')
		->will($this->returnCallback(array($this, 'create_datetime_callback')));

		$this->user->timezone = new DateTimeZone('UTC');
		$this->user->lang = array(
			'datetime' => array(),
			'DATE_FORMAT' => 'm/d/Y',
		);

		$request = $this->createMock('\phpbb\request\request');
		$template = $this->createMock('\phpbb\template\template');

		$this->cp = new \phpbb\profilefields\type\type_date(
			$request,
			$template,
			$this->user
		);

		$this->field_options = array(
			'field_type'     => '\phpbb\profilefields\type\type_date',
			'field_name'   => 'field',
			'field_id'    => 1,
			'lang_id'    => 1,
			'lang_name'      => 'field',
			'field_required' => false,
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function profile_value_data() {
		return array(
			array(
				'01-01-2009',
				array('field_show_novalue' => true),
				'01/01/2009',
				'Field should output the correctly formatted date',
			),
			array(
				null,
				array('field_show_novalue' => false),
				null,
				'Field should leave empty value as is',
			),
			array(
				'None',
				array('field_show_novalue' => true),
				'None',
				'Field should leave invalid value as is',
			),
		);
	}


	/**
	 *
	 * @dataProvider profile_value_data
	 * @param unknown $value
	 * @param unknown $field_options
	 * @param unknown $expected
	 * @param unknown $description
	 */
	public function test_get_profile_value($value, $field_options, $expected, $description) {
		$field_options = array_merge($this->field_options, $field_options);

		$result = $this->cp->get_profile_value($value, $field_options);

		$this->assertSame($expected, $result, $description);
	}


	/**
	 *
	 * @return unknown
	 */
	public function validate_profile_field_data() {
		return array(
			array(
				'',
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being empty',
			),
			array(
				'0125',
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being invalid',
			),
			array(
				'01-01-2012',
				array(),
				false,
				'Field should accept a valid value',
			),
			array(
				'40-05-2009',
				array(),
				'FIELD_INVALID_DATE-field',
				'Field should reject value for being invalid',
			),
			array(
				'12-30-2012',
				array(),
				'FIELD_INVALID_DATE-field',
				'Field should reject value for being invalid',
			),
			array(
				'string',
				array(),
				false,
				'Field should reject value for being invalid',
			),
			array(
				'string',
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being invalid',
			),
			array(
				100,
				array(),
				false,
				'Field should reject value for being invalid',
			),
			array(
				100,
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being invalid',
			),
			array(
				null,
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being empty',
			),
			array(
				true,
				array('field_required' => true),
				'FIELD_REQUIRED-field',
				'Field should reject value for being empty',
			),
		);
	}


	/**
	 *
	 * @dataProvider validate_profile_field_data
	 * @param unknown $value
	 * @param unknown $field_options
	 * @param unknown $expected
	 * @param unknown $description
	 */
	public function test_validate_profile_field($value, $field_options, $expected, $description) {
		$field_options = array_merge($this->field_options, $field_options);

		$result = $this->cp->validate_profile_field($value, $field_options);

		$this->assertSame($expected, $result, $description);
	}


	/**
	 *
	 * @return unknown
	 */
	public function profile_value_raw_data() {
		return array(
			array(
				'',
				array('field_show_novalue' => false),
				null,
				'Field should return the correct raw value',
			),
			array(
				'',
				array('field_show_novalue' => true),
				'',
				'Field should return correct raw value',
			),
			array(
				'12/06/2014',
				array('field_show_novalue' => true),
				'12/06/2014',
				'Field should return correct raw value',
			),
		);
	}


	/**
	 *
	 * @dataProvider profile_value_raw_data
	 * @param unknown $value
	 * @param unknown $field_options
	 * @param unknown $expected
	 * @param unknown $description
	 */
	public function test_get_profile_value_raw($value, $field_options, $expected, $description) {
		$field_options = array_merge($this->field_options, $field_options);

		$result = $this->cp->get_profile_value_raw($value, $field_options);

		$this->assertSame($expected, $result, $description);
	}


	/**
	 *
	 * @return unknown
	 */
	public function return_callback_implode() {
		return implode('-', func_get_args());
	}


	/**
	 *
	 * @param unknown      $time     (optional)
	 * @param DateTimeZone $timezone (optional)
	 * @return unknown
	 */
	public function create_datetime_callback($time = 'now', \DateTimeZone $timezone = null) {
		$timezone = $timezone ?: $this->user->timezone;
		return new \phpbb\datetime($this->user, $time, $timezone);
	}


}
