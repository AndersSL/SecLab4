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


namespace phpbb\attachment;

/**
 * Attachment manager
 */
class manager {
	/** @var delete Attachment delete class */
	protected $delete;

	/** @var resync Attachment resync class */
	protected $resync;

	/** @var upload Attachment upload class */
	protected $upload;

	/**
	 * Constructor for attachment manager
	 *
	 * @param delete  $delete Attachment delete class
	 * @param resync  $resync Attachment resync class
	 * @param upload  $upload Attachment upload class
	 */
	public function __construct(delete $delete, resync $resync, upload $upload) {
		$this->delete = $delete;
		$this->resync = $resync;
		$this->upload = $upload;
	}


	/**
	 * Wrapper method for deleting attachments
	 *
	 *
	 *   went wrong during attachment deletion
	 *
	 * @param string  $mode   can be: post|message|topic|attach|user
	 * @param mixed   $ids    can be: post_ids, message_ids, topic_ids, attach_ids, user_ids
	 * @param bool    $resync (optional) set this to false if you are deleting posts or topics
	 * @return int|bool Number of deleted attachments or false if something
	 */
	public function delete($mode, $ids, $resync = true) {
		return $this->delete->delete($mode, $ids, $resync);
	}


	/**
	 * Wrapper method for deleting attachments from filesystem
	 *
	 * @param string  $filename      Filename of attachment
	 * @param string  $mode          (optional) Delete mode
	 * @param bool    $entry_removed (optional) Whether entry was removed. Defaults to false
	 * @return bool True if file was removed, false if not
	 */
	public function unlink($filename, $mode = 'file', $entry_removed = false) {
		return $this->delete->unlink_attachment($filename, $mode, $entry_removed);
	}


	/**
	 * Wrapper method for resyncing specified type
	 *
	 * @param string  $type Type of resync
	 * @param array   $ids  IDs to resync
	 */
	public function resync($type, $ids) {
		$this->resync->resync($type, $ids);
	}


	/**
	 * Wrapper method for uploading attachment
	 *
	 *
	 * @param string  $form_name      The form name of the file upload input
	 * @param int     $forum_id       The id of the forum
	 * @param bool    $local          (optional) Whether the file is local or not
	 * @param string  $local_storage  (optional) The path to the local file
	 * @param bool    $is_message     (optional) Whether it is a PM or not
	 * @param array   $local_filedata (optional) An file data object created for the local file
	 * @return array File data array
	 */
	public function upload($form_name, $forum_id, $local = false, $local_storage = '', $is_message = false, $local_filedata = []) {
		return $this->upload->upload($form_name, $forum_id, $local, $local_storage, $is_message, $local_filedata);
	}


}
