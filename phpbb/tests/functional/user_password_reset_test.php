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


/**
 *
 * @group functional
 */
class phpbb_functional_user_password_reset_test extends phpbb_functional_test_case
{
	protected $user_data;

	/**
	 *
	 */
	public function test_password_reset() {
		$this->add_lang('ucp');
		$user_id = $this->create_user('reset-password-test-user', 'reset-password-test-user@test.com');

		// test without email
		$crawler = self::request('GET', "ucp.php?mode=sendpassword&sid={$this->sid}");
		$this->assertContains('app.php/user/forgot_password', $crawler->getUri());
		$form = $crawler->selectButton('submit')->form();
		$crawler = self::submit($form);
		$this->assertContainsLang('NO_EMAIL_USER', $crawler->text());

		// test with non-existent email
		$crawler = self::request('GET', "app.php/user/forgot_password?sid={$this->sid}");
		$form = $crawler->selectButton('submit')->form(array(
				'email' => 'non-existent@email.com',
			));
		$crawler = self::submit($form);
		$this->assertContainsLang('PASSWORD_RESET_LINK_SENT', $crawler->text());

		// test with correct email
		$crawler = self::request('GET', "app.php/user/forgot_password?sid={$this->sid}");
		$form = $crawler->selectButton('submit')->form(array(
				'email'  => 'reset-password-test-user@test.com',
			));
		$crawler = self::submit($form);
		$this->assertContainsLang('PASSWORD_RESET_LINK_SENT', $crawler->text());

		// Check if columns in database were updated for password reset
		$this->get_user_data('reset-password-test-user');
		$this->assertNotEmpty($this->user_data['reset_token']);
		$this->assertNotEmpty($this->user_data['reset_token_expiration']);
		$reset_token = $this->user_data['reset_token'];
		$reset_token_expiration = $this->user_data['reset_token_expiration'];

		// Check that reset token is only created once per day
		$crawler = self::request('GET', "app.php/user/forgot_password?sid={$this->sid}");
		$form = $crawler->selectButton('submit')->form(array(
				'email'  => 'reset-password-test-user@test.com',
			));
		$crawler = self::submit($form);
		$this->assertContainsLang('PASSWORD_RESET_LINK_SENT', $crawler->text());

		$this->get_user_data('reset-password-test-user');
		$this->assertNotEmpty($this->user_data['reset_token']);
		$this->assertNotEmpty($this->user_data['reset_token_expiration']);
		$this->assertEquals($reset_token, $this->user_data['reset_token']);
		$this->assertEquals($reset_token_expiration, $this->user_data['reset_token_expiration']);

		// Create another user with the same email
		$this->create_user('reset-password-test-user1', 'reset-password-test-user@test.com');

		// Test that username is now also required
		$crawler = self::request('GET', "app.php/user/forgot_password?sid={$this->sid}");
		$form = $crawler->selectButton('submit')->form(array(
				'email'  => 'reset-password-test-user@test.com',
			));
		$crawler = self::submit($form);
		$this->assertContainsLang('EMAIL_NOT_UNIQUE', $crawler->text());

		// Provide both username and email
		$form = $crawler->selectButton('submit')->form(array(
				'email'  => 'reset-password-test-user@test.com',
				'username' => 'reset-password-test-user1',
			));
		$crawler = self::submit($form);
		$this->assertContainsLang('PASSWORD_RESET_LINK_SENT', $crawler->text());

		// Check if columns in database were updated for password reset
		$this->get_user_data('reset-password-test-user1');
		$this->assertNotEmpty($this->user_data['reset_token']);
		$this->assertNotEmpty($this->user_data['reset_token_expiration']);
		$this->assertGreaterThan(time(), $this->user_data['reset_token_expiration']);
	}


	/**
	 *
	 */
	public function test_login_after_reset() {
		$this->login('reset-password-test-user');
	}


	/**
	 *
	 * @return unknown
	 */
	public function data_reset_user_password() {
		return [
			['RESET_TOKEN_EXPIRED_OR_INVALID', 0, 'abcdef'],
			['NO_USER', ' ', 'abcdef'],
			['NO_RESET_TOKEN', 0, ' '],
			['RESET_TOKEN_EXPIRED_OR_INVALID', 2, ''],
			['RESET_TOKEN_EXPIRED_OR_INVALID', 1e7, ''],
			['', 0, ''],
			['NO_RESET_TOKEN', 0, ''], // already reset
		];
	}


	/**
	 *
	 * @dataProvider data_reset_user_password
	 * @param unknown $expected
	 * @param unknown $user_id
	 * @param unknown $token
	 */
	public function test_reset_user_password($expected, $user_id, $token) {
		$this->add_lang('ucp');
		$this->get_user_data('reset-password-test-user');
		$user_id = !$user_id ? $this->user_data['user_id'] : $user_id;
		$token = !$token ? $this->user_data['reset_token'] : $token;

		$crawler = self::request('GET', "app.php/user/reset_password?u=$user_id&token=$token");

		if ($expected) {
			$this->assertContainsLang($expected, $crawler->text());
		}
		else {
			$form = $crawler->filter('input[type=submit]')->form();
			$values = array_merge($form->getValues(), [
					'new_password'   => 'reset-password-test-user',
					'new_password_confirm' => 'reset-password-test-user',
				]);
			$crawler = self::submit($form, $values);
			$this->assertContainsLang('PASSWORD_RESET', $crawler->text());
		}
	}


	/**
	 *
	 */
	public function test_login() {
		$this->add_lang('ucp');
		$crawler = self::request('GET', 'ucp.php');
		$this->assertContains($this->lang('LOGIN_EXPLAIN_UCP'), $crawler->filter('html')->text());

		$form = $crawler->selectButton($this->lang('LOGIN'))->form();
		$crawler = self::submit($form, array('username' => 'reset-password-test-user', 'password' => 'reset-password-test-user'));
		$this->assertNotContains($this->lang('LOGIN'), $crawler->filter('.navbar')->text());

		$cookies = self::$cookieJar->all();

		// The session id is stored in a cookie that ends with _sid - we assume there is only one such cookie
		foreach ($cookies as $cookie) {
			if (substr($cookie->getName(), -4) == '_sid') {
				$this->sid = $cookie->getValue();
			}
		}

		$this->logout();

		$crawler = self::request('GET', 'ucp.php');
		$this->assertContains($this->lang('LOGIN_EXPLAIN_UCP'), $crawler->filter('html')->text());

		$form = $crawler->selectButton($this->lang('LOGIN'))->form();
		// Try logging in with the old password
		$crawler = self::submit($form, array('username' => 'reset-password-test-user', 'password' => 'reset-password-test-userreset-password-test-user'));
		$this->assertContains($this->lang('LOGIN_ERROR_PASSWORD', '', ''), $crawler->filter('html')->text());
	}


	/**
	 *
	 * @depends test_login
	 */
	public function test_acivateAfterDeactivate() {
		// User is active, actkey should not exist
		$this->get_user_data('reset-password-test-user');
		$this->assertEmpty($this->user_data['user_actkey']);

		$this->login();
		$this->admin_login();
		$this->add_lang('acp/users');

		// Go to user account page
		$crawler = self::request('GET', 'adm/index.php?i=acp_users&mode=overview&sid=' . $this->sid);
		$this->assertContainsLang('FIND_USERNAME', $crawler->filter('html')->text());

		$form = $crawler->selectButton('Submit')->form();
		$crawler = self::submit($form, array('username' => 'reset-password-test-user'));

		// Deactivate account and go back to overview of current user
		$this->assertContainsLang('USER_TOOLS', $crawler->filter('html')->text());
		$form = $crawler->filter('input[name=update]')->selectButton('Submit')->form();
		$crawler = self::submit($form, array('action' => 'active'));

		$this->assertContainsLang('USER_ADMIN_DEACTIVED', $crawler->filter('html')->text());
		$link = $crawler->selectLink('Back to previous page')->link();
		$crawler = self::request('GET', preg_replace('#(.+)(adm/index.php.+)#', '$2', $link->getUri()));

		// Ensure again that actkey is empty after deactivation
		$this->get_user_data('reset-password-test-user');
		$this->assertEmpty($this->user_data['user_actkey']);

		// Force reactivation of account and check that act key is not empty anymore
		$this->assertContainsLang('USER_TOOLS', $crawler->filter('html')->text());
		$form = $crawler->filter('input[name=update]')->selectButton('Submit')->form();
		$crawler = self::submit($form, array('action' => 'reactivate'));
		$this->assertContainsLang('FORCE_REACTIVATION_SUCCESS', $crawler->filter('html')->text());

		$this->get_user_data('reset-password-test-user');
		$this->assertNotEmpty($this->user_data['user_actkey']);
	}


	/**
	 *
	 * @param unknown $username
	 */
	protected function get_user_data($username) {
		$db = $this->get_db();
		$sql = 'SELECT user_id, username, user_type, user_email, user_newpasswd, user_lang, user_notify_type, user_actkey, user_inactive_reason, reset_token, reset_token_expiration
			FROM ' . USERS_TABLE . "
			WHERE username = '" . $db->sql_escape($username) . "'";
		$result = $db->sql_query($sql);
		$this->user_data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}


}
