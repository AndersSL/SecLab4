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


namespace phpbb\db\migration\data\v330;

class remove_attachment_flash extends \phpbb\db\migration\migration
{
	// Following constants were deprecated in 3.3
	// and moved from constants.php to compatibility_globals.php,
	// thus define them as class constants
	const ATTACHMENT_CATEGORY_FLASH = 5;

	protected $cat_id = array(
		self::ATTACHMENT_CATEGORY_FLASH,
	);

	/**
	 *
	 * @return unknown
	 */
	public static function depends_on() {
		return ['\phpbb\db\migration\data\v330\dev', ];
	}


	/**
	 *
	 * @return unknown
	 */
	public function update_data() {
		return array(
			array('custom', array(array($this, 'remove_flash_group'))),
		);
	}


	/**
	 *
	 * @return unknown
	 */
	public function remove_flash_group() {
		// select group ids of outdated media
		$sql = 'SELECT group_id
			FROM ' . EXTENSION_GROUPS_TABLE . '
			WHERE ' . $this->db->sql_in_set('cat_id', $this->cat_id);
		$result = $this->db->sql_query($sql);

		$group_ids = array();
		while ($group_id = (int) $this->db->sql_fetchfield('group_id')) {
			$group_ids[] = $group_id;
		}
		$this->db->sql_freeresult($result);

		// nothing to do, admin has removed all the outdated media extension groups
		if (empty($group_ids)) {
			return true;
		}

		// get the group id of downloadable files
		$sql = 'SELECT group_id
			FROM ' . EXTENSION_GROUPS_TABLE . "
			WHERE group_name = 'DOWNLOADABLE_FILES'";
		$result = $this->db->sql_query($sql);
		$download_id = (int) $this->db->sql_fetchfield('group_id');
		$this->db->sql_freeresult($result);

		if (empty($download_id)) {
			$sql = 'UPDATE ' . EXTENSIONS_TABLE . '
				SET group_id = 0
				WHERE ' . $this->db->sql_in_set('group_id', $group_ids);
		}
		else {
			// move outdated media extensions to downloadable files
			$sql = 'UPDATE ' . EXTENSIONS_TABLE . "
				SET group_id = $download_id" . '
				WHERE ' . $this->db->sql_in_set('group_id', $group_ids);
		}

		$this->db->sql_query($sql);

		// delete the now empty, outdated media extension groups
		$sql = 'DELETE FROM ' . EXTENSION_GROUPS_TABLE . '
			WHERE ' . $this->db->sql_in_set('group_id', $group_ids);
		$this->db->sql_query($sql);
	}


}
