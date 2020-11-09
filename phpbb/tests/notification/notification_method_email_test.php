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


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once dirname(__FILE__) . '/base.php';

class notification_method_email_test extends phpbb_tests_notification_base
{
	/** @var \phpbb\notification\method\email */
	protected $notification_method_email;

	/**
	 *
	 * @return unknown
	 */
	public function getDataSet() {
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/email_notification.type.post.xml');
	}


	/**
	 *
	 * @return unknown
	 */
	protected function get_notification_methods() {
		return [
			'notification.method.email',
		];
	}


	/**
	 *
	 */
	protected function setUp() : void
	{
		phpbb_database_test_case::setUp();

		global $phpbb_root_path, $phpEx;

		include_once __DIR__ . '/ext/test/notification/type/test.' . $phpEx;

		global $db, $config, $user, $auth, $cache, $phpbb_container;

		$db = $this->db = $this->new_dbal();
		$config = $this->config = new \phpbb\config\config([
				'allow_privmsg'   => true,
				'allow_bookmarks'  => true,
				'allow_topic_notify' => true,
				'allow_forum_notify' => true,
				'allow_board_notifications' => true,
			]);
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$this->user = $user;
		$this->user_loader = new \phpbb\user_loader($this->db, $phpbb_root_path, $phpEx, 'phpbb_users');
		$auth = $this->auth = new phpbb_mock_notifications_auth();
		$cache_driver = new \phpbb\cache\driver\dummy();
		$cache = $this->cache = new \phpbb\cache\service(
			$cache_driver,
			$this->config,
			$this->db,
			$phpbb_root_path,
			$phpEx
		);

		$this->phpbb_dispatcher = new phpbb_mock_event_dispatcher();

		$phpbb_container = $this->container = new ContainerBuilder();
		$loader     = new YamlFileLoader($phpbb_container, new FileLocator(__DIR__ . '/fixtures'));
		$loader->load('services_notification.yml');
		$phpbb_container->set('user_loader', $this->user_loader);
		$phpbb_container->set('user', $user);
		$phpbb_container->set('language', $lang);
		$phpbb_container->set('config', $this->config);
		$phpbb_container->set('dbal.conn', $this->db);
		$phpbb_container->set('auth', $auth);
		$phpbb_container->set('cache.driver', $cache_driver);
		$phpbb_container->set('cache', $cache);
		$phpbb_container->set('text_formatter.utils', new \phpbb\textformatter\s9e\utils());
		$phpbb_container->set('dispatcher', $this->phpbb_dispatcher);
		$phpbb_container->setParameter('core.root_path', $phpbb_root_path);
		$phpbb_container->setParameter('core.php_ext', $phpEx);
		$phpbb_container->setParameter('tables.notifications', 'phpbb_notifications');
		$phpbb_container->setParameter('tables.user_notifications', 'phpbb_user_notifications');
		$phpbb_container->setParameter('tables.notification_types', 'phpbb_notification_types');
		$phpbb_container->setParameter('tables.notification_emails', 'phpbb_notification_emails');

		$this->notification_method_email = $this->getMockBuilder('\phpbb\notification\method\email')
		->setConstructorArgs([
				$phpbb_container->get('user_loader'),
				$phpbb_container->get('user'),
				$phpbb_container->get('config'),
				$phpbb_container->get('dbal.conn'),
				$phpbb_root_path,
				$phpEx,
				$phpbb_container->getParameter('tables.notification_emails')
			])
		->setMethods(['notify_using_messenger'])
		->getMock();
		$notification_method_email = $this->notification_method_email;

		$class = new ReflectionClass($notification_method_email);
		$empty_queue_method = $class->getMethod('empty_queue');
		$empty_queue_method->setAccessible(true);

		$this->notification_method_email->method('notify_using_messenger')
		->will($this->returnCallback(function () use ($notification_method_email, $empty_queue_method) {
					$empty_queue_method->invoke($notification_method_email);
				}));

		$phpbb_container->set('notification.method.email', $this->notification_method_email);

		$this->notifications = new phpbb_notification_manager_helper(
			array(),
			array(),
			$this->container,
			$this->user_loader,
			$this->phpbb_dispatcher,
			$this->db,
			$this->cache,
			$lang,
			$this->user,
			'phpbb_notification_types',
			'phpbb_user_notifications'
		);

		$phpbb_container->set('notification_manager', $this->notifications);
		$phpbb_container->compile();

		$this->notifications->setDependencies($this->auth, $this->config);

		$types = array();
		foreach ($this->get_notification_types() as $type) {
			$class = $this->build_type($type);

			$types[$type] = $class;
		}

		$this->notifications->set_var('notification_types', $types);

		$methods = array();
		foreach ($this->get_notification_methods() as $method) {
			$class = $this->container->get($method);

			$methods[$method] = $class;
		}

		$this->notifications->set_var('notification_methods', $methods);
	}


	/**
	 *
	 * @return unknown
	 */
	public function data_notification_email() {
		return [
			[
				[
					'forum_id'  => '1',
					'post_id'  => '2',
					'topic_id'  => '1',
				],
				[
					2 => ['user_id' => '2'],
					3 => ['user_id' => '3'],
					4 => ['user_id' => '4'],
					5 => ['user_id' => '5'],
					6 => ['user_id' => '6'],
					7 => ['user_id' => '7'],
					8 => ['user_id' => '8']
				],
			],
			[
				[
					'forum_id'  => '1',
					'post_id'  => '4',
					'topic_id'  => '2',
				],
				[
					2 => ['user_id' => '2'],
					6 => ['user_id' => '6'],
					7 => ['user_id' => '7'],
					8 => ['user_id' => '8'],
				],
			],
			[
				[
					'forum_id'  => '2',
					'post_id'  => '6',
					'topic_id'  => '3',
				],
				[
				],
			],
		];
	}


	/**
	 *
	 * @dataProvider data_notification_email
	 * @param unknown $post_data
	 * @param unknown $expected_users
	 */
	public function test_notification_email($post_data, $expected_users) {
		$post_data = array_merge(['post_time' => 1349413322], $post_data);
		$notification_options = [
			'item_id'   => $post_data['post_id'],
			'item_parent_id' => $post_data['topic_id'],
		];

		$notified_users = $this->notification_method_email->get_notified_users($this->notifications->get_notification_type_id('notification.type.post'), $notification_options);
		$this->assertEquals(0, count($notified_users), 'Assert no user has been notified yet');

		$this->notifications->add_notifications('notification.type.post', $post_data);

		$notified_users = $this->notification_method_email->get_notified_users($this->notifications->get_notification_type_id('notification.type.post'), $notification_options);
		$this->assertEquals($expected_users, $notified_users, 'Assert that expected users have been notified');

		$post_data['post_id']++;
		$notification_options['item_id'] = $post_data['post_id'];
		$post_data['post_time'] = 1349413323;

		$this->notifications->add_notifications('notification.type.post', $post_data);

		$notified_users2 = $this->notification_method_email->get_notified_users($this->notifications->get_notification_type_id('notification.type.post'), $notification_options);
		$this->assertEquals($expected_users, $notified_users2, 'Assert that expected users stay the same after replying to same topic');
	}


}