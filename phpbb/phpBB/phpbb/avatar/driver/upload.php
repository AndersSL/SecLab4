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

use bantu\IniGetWrapper\IniGetWrapper;
use \phpbb\storage\exception\exception as storage_exception;

/**
 * Handles avatars uploaded to the board
 */
class upload extends \phpbb\avatar\driver\driver
{

	/**
	 *
	 * @var \phpbb\storage\storage
	 */
	protected $storage;

	/**
	 *
	 * @var \phpbb\event\dispatcher_interface
	 */
	protected $dispatcher;

	/**
	 *
	 * @var \phpbb\files\factory
	 */
	protected $files_factory;

	/**
	 *
	 * @var IniGetWrapper
	 */
	protected $php_ini;

	/**
	 * Construct a driver object
	 *
	 * @param \phpbb\storage\storage                             phpBB avatar storage
	 * @param \phpbb\config\config              $config          phpBB configuration
	 * @param string                            $phpbb_root_path Path to the phpBB root
	 * @param string                            $php_ext         PHP file extension
	 * @param storage                           $storage
	 * @param \phpbb\path_helper                $path_helper     phpBB path helper
	 * @param \phpbb\event\dispatcher_interface $dispatcher      phpBB Event dispatcher object
	 * @param \phpbb\files\factory              $files_factory   File classes factory
	 * @param IniGetWrapper                     $php_ini         ini_get() wrapper
	 */
	public function __construct(\phpbb\config\config $config, $phpbb_root_path, $php_ext, \phpbb\storage\storage $storage, \phpbb\path_helper $path_helper, \phpbb\event\dispatcher_interface $dispatcher, \phpbb\files\factory $files_factory, IniGetWrapper $php_ini) {
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->storage = $storage;
		$this->path_helper = $path_helper;
		$this->dispatcher = $dispatcher;
		$this->files_factory = $files_factory;
		$this->php_ini = $php_ini;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $row
	 * @return unknown
	 */
	public function get_data($row) {
		$root_path = (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : $this->path_helper->get_web_root_path();

		return array(
			'src' => $root_path . 'download/file.' . $this->php_ext . '?avatar=' . $row['avatar'],
			'width' => $row['avatar_width'],
			'height' => $row['avatar_height'],
		);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $request
	 * @param unknown $template
	 * @param unknown $user
	 * @param unknown $row
	 * @param unknown $error    (reference)
	 * @return unknown
	 */
	public function prepare_form($request, $template, $user, $row, &$error) {
		if (!$this->can_upload()) {
			return false;
		}

		$template->assign_vars(array(
				'S_UPLOAD_AVATAR_URL' => ($this->config['allow_avatar_remote_upload']) ? true : false,
				'AVATAR_UPLOAD_SIZE' => $this->config['avatar_filesize'],
				'AVATAR_ALLOWED_EXTENSIONS' => implode(',', preg_replace('/^/', '.', $this->allowed_extensions)),
			));

		return true;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $request
	 * @param unknown $template
	 * @param unknown $user
	 * @param unknown $row
	 * @param unknown $error    (reference)
	 * @return unknown
	 */
	public function process_form($request, $template, $user, $row, &$error) {
		if (!$this->can_upload()) {
			return false;
		}

		/** @var \phpbb\files\upload $upload */
		$upload = $this->files_factory->get('upload')
		->set_error_prefix('AVATAR_')
		->set_allowed_extensions($this->allowed_extensions)
		->set_max_filesize($this->config['avatar_filesize'])
		->set_allowed_dimensions(
			$this->config['avatar_min_width'],
			$this->config['avatar_min_height'],
			$this->config['avatar_max_width'],
			$this->config['avatar_max_height'])
		->set_disallowed_content((isset($this->config['mime_triggers']) ? explode('|', $this->config['mime_triggers']) : false));

		$url = $request->variable('avatar_upload_url', '');
		$upload_file = $request->file('avatar_upload_file');

		if (!empty($upload_file['name'])) {
			$file = $upload->handle_upload('files.types.form_storage', 'avatar_upload_file');
		}
		else if (!empty($this->config['allow_avatar_remote_upload']) && !empty($url)) {
			if (!preg_match('#^(http|https|ftp)://#i', $url)) {
				$url = 'http://' . $url;
			}

			if (!function_exists('validate_data')) {
				require $this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext;
			}

			$validate_array = validate_data(
				array(
					'url' => $url,
				),
				array(
					'url' => array('string', true, 5, 255),
				)
			);

			$error = array_merge($error, $validate_array);

			if (!empty($error)) {
				return false;
			}

			// Do not allow specifying the port (see RFC 3986) or IP addresses
			// remote_upload() will do its own check for allowed filetypes
			if (!preg_match('#^(http|https|ftp)://(?:(.*?\.)*?[a-z0-9\-]+?\.[a-z]{2,4}|(?:\d{1,3}\.){3,5}\d{1,3}):?([0-9]*?).*?\.('. implode('|', $this->allowed_extensions) . ')$#i', $url) ||
				preg_match('@^(http|https|ftp)://[^/:?#]+:[0-9]+[/:?#]@i', $url) ||
				preg_match('#^(http|https|ftp)://(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])#i', $url) ||
				preg_match('#^(http|https|ftp)://(?:(?:(?:[\dA-F]{1,4}:){6}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:::(?:[\dA-F]{1,4}:){0,5}(?:[\dA-F]{1,4}(?::[\dA-F]{1,4})?|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:):(?:[\dA-F]{1,4}:){4}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,2}:(?:[\dA-F]{1,4}:){3}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,3}:(?:[\dA-F]{1,4}:){2}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,4}:(?:[\dA-F]{1,4}:)(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,5}:(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,6}:[\dA-F]{1,4})|(?:(?:[\dA-F]{1,4}:){1,7}:)|(?:::))#i', $url)) {
				$error[] = 'AVATAR_URL_INVALID';
				return false;
			}

			$file = $upload->handle_upload('files.types.remote_storage', $url);
		}
		else {
			return false;
		}

		$prefix = $this->config['avatar_salt'] . '_';
		$file->clean_filename('avatar', $prefix, $row['id']);

		// If there was an error during upload, then abort operation
		if (count($file->error)) {
			$file->remove($this->storage);
			$error = $file->error;
			return false;
		}

		$filedata = array(
			'filename'   => $file->get('filename'),
			'filesize'   => $file->get('filesize'),
			'mimetype'   => $file->get('mimetype'),
			'extension'   => $file->get('extension'),
			'physical_filename' => $file->get('realname'),
			'real_filename'  => $file->get('uploadname'),
		);

		/**
		 * Before moving new file in place (and eventually overwriting the existing avatar with the newly uploaded avatar)
		 *
		 * @event core.avatar_driver_upload_move_file_before
		 * @var array filedata   Array containing uploaded file data
		 * @var \phpbb\files\filespec file Instance of filespec class
		 * @var string prefix    Prefix for the avatar filename
		 * @var array row     Array with avatar row data
		 * @var array error    Array of errors, if filled in by this event file will not be moved
		 * @since 3.1.6-RC1
		 * @changed 3.1.9-RC1 Added filedata
		 * @changed 3.2.3-RC1 Added file
		 */
		$vars = array(
			'filedata',
			'file',
			'prefix',
			'row',
			'error',
		);
		extract($this->dispatcher->trigger_event('core.avatar_driver_upload_move_file_before', compact($vars)));

		unset($filedata);

		if (!count($error)) {
			// Move file and overwrite any existing image
			$file->move_file($this->storage, true);
		}

		// If there was an error during move, then clean up leftovers
		$error = array_merge($error, $file->error);
		if (count($error)) {
			$file->remove($this->storage);
			return false;
		}

		// Delete current avatar if not overwritten
		$ext = substr(strrchr($row['avatar'], '.'), 1);
		if ($ext && $ext !== $file->get('extension')) {
			$this->delete($row);
		}

		return array(
			'avatar' => $row['id'] . '_' . time() . '.' . $file->get('extension'),
			'avatar_width' => $file->get('width'),
			'avatar_height' => $file->get('height'),
		);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $user
	 * @return unknown
	 */
	public function prepare_form_acp($user) {
		return array(
			'allow_avatar_remote_upload'=> array('lang' => 'ALLOW_REMOTE_UPLOAD', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
			'avatar_filesize'  => array('lang' => 'MAX_FILESIZE',   'validate' => 'int:0', 'type' => 'number:0', 'explain' => true, 'append' => ' ' . $user->lang['BYTES']),
		);
	}


	/**
	 * {@inheritdoc}
	 *
	 * @param unknown $row
	 * @return unknown
	 */
	public function delete($row) {

		$error = array();
		$prefix = $this->config['avatar_salt'] . '_';
		$ext = substr(strrchr($row['avatar'], '.'), 1);
		$filename = $prefix . $row['id'] . '.' . $ext;

		/**
		 * Before deleting an existing avatar
		 *
		 * @event core.avatar_driver_upload_delete_before
		 * @var string prefix    Prefix for the avatar filename
		 * @var array row     Array with avatar row data
		 * @var array error    Array of errors, if filled in by this event file will not be deleted
		 * @since 3.1.6-RC1
		 * @changed 3.3.0-a1     Remove destination
		 */
		$vars = array(
			'prefix',
			'row',
			'error',
		);
		extract($this->dispatcher->trigger_event('core.avatar_driver_upload_delete_before', compact($vars)));

		if (!count($error) && $this->storage->exists($filename)) {
			try
			{
				$this->storage->delete($filename);
				return true;
			}
			catch (storage_exception $e) {
				// Fail is covered by return statement below
			}
		}

		return false;
	}


	/**
	 * {@inheritdoc}
	 *
	 * @return unknown
	 */
	public function get_template_name() {
		return 'ucp_avatar_options_upload.html';
	}


	/**
	 * Check if user is able to upload an avatar to a temporary folder
	 *
	 * @return bool True if user can upload, false if not
	 */
	protected function can_upload() {
		return $this->php_ini->getBool('file_uploads');
	}


}
