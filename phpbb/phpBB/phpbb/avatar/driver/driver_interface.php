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


namespace phpbb\avatar\driver;

/**
 * Interface for avatar drivers
 */
interface driver_interface
{

	/**
	 * Returns the name of the driver.
	 *
	 * @return string Name of driver.
	 */
	public function get_name();

	/**
	 * Returns the config name of the driver. To be used in accessing the CONFIG variables.
	 *
	 * @return string Config name of driver.
	 */
	public function get_config_name();

	/**
	 * Get the avatar url and dimensions
	 *
	 *        \phpbb\avatar\manager::clean_row
	 *
	 *        ['src' => '', 'width' => 0, 'height' => 0]
	 *
	 * @param array   $row User data or group data that has been cleaned with
	 * @return array Avatar data, must have keys src, width and height, e.g.
	 */
	public function get_data($row);

	/**
	 * Returns custom html if it is needed for displaying this avatar
	 *
	 *        \phpbb\avatar\manager::clean_row
	 *
	 * @param \phpbb\user $user phpBB user object
	 * @param array       $row  User data or group data that has been cleaned with
	 * @param string      $alt  (optional) Alternate text for avatar image
	 * @return string HTML
	 */
	public function get_custom_html($user, $row, $alt = '');

	/**
	 * Prepare form for changing the settings of this avatar
	 *
	 *        \phpbb\avatar\manager::clean_row
	 *        function. Key values can either be a string with a language key or
	 *        an array that will be passed to vsprintf() with the language key in
	 *        the first array key.
	 *
	 * @param \phpbb\request\request   $request  Request object
	 * @param \phpbb\template\template $template Template object
	 * @param \phpbb\user              $user     User object
	 * @param array                    $row      User data or group data that has been cleaned with
	 * @param array                    &$error   Reference to an error array that is filled by this
	 * @return bool True if form has been successfully prepared
	 */
	public function prepare_form($request, $template, $user, $row, &$error);

	/**
	 * Prepare form for changing the acp settings of this avatar
	 *
	 *
	 *        The setting for enabling/disabling the avatar will be handled by
	 *        the avatar manager.
	 *
	 * @param \phpbb\user $user phpBB user object
	 * @return array Array of configuration options as consumed by acp_board.
	 */
	public function prepare_form_acp($user);

	/**
	 * Process form data
	 *
	 *        \phpbb\avatar\manager::clean_row
	 *        function. Key values can either be a string with a language key or
	 *        an array that will be passed to vsprintf() with the language key in
	 *        the first array key.
	 *
	 *        ['avatar'], ['avatar_width'], ['avatar_height']
	 *
	 * @param \phpbb\request\request   $request  Request object
	 * @param \phpbb\template\template $template Template object
	 * @param \phpbb\user              $user     User object
	 * @param array                    $row      User data or group data that has been cleaned with
	 * @param array                    &$error   Reference to an error array that is filled by this
	 * @return array Array containing the avatar data as follows:
	 */
	public function process_form($request, $template, $user, $row, &$error);

	/**
	 * Delete avatar
	 *
	 *        \phpbb\avatar\manager::clean_row
	 *
	 *        i.e. when the avatar is not hosted locally.
	 *
	 * @param array   $row User data or group data that has been cleaned with
	 * @return bool True if avatar has been deleted or there is no need to delete,
	 */
	public function delete($row);

	/**
	 * Get the avatar driver's template name
	 *
	 * @return string Avatar driver's template name
	 */
	public function get_template_name();

	/**
	 * Get the avatar driver's template name (ACP)
	 *
	 * @return string Avatar driver's template name
	 */
	public function get_acp_template_name();
}
