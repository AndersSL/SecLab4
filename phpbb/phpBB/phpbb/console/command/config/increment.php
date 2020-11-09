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


namespace phpbb\console\command\config;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class increment extends command
{

	/**
	 * {@inheritdoc}
	 */
	protected function configure() {
		$this
		->setName('config:increment')
		->setDescription($this->user->lang('CLI_DESCRIPTION_INCREMENT_CONFIG'))
		->addArgument(
			'key',
			InputArgument::REQUIRED,
			$this->user->lang('CLI_CONFIG_OPTION_NAME')
		)
		->addArgument(
			'increment',
			InputArgument::REQUIRED,
			$this->user->lang('CLI_CONFIG_INCREMENT_BY')
		)
		->addOption(
			'dynamic',
			'd',
			InputOption::VALUE_NONE,
			$this->user->lang('CLI_CONFIG_CANNOT_CACHED')
		)
		;
	}


	/**
	 * Executes the command config:increment.
	 *
	 * Increments an integer configuration value.
	 *
	 *
	 * @see \phpbb\config\config::increment()
	 * @param InputInterface  $input  An InputInterface instance
	 * @param OutputInterface $output An OutputInterface instance
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		$io = new SymfonyStyle($input, $output);

		$key = $input->getArgument('key');
		$increment = $input->getArgument('increment');
		$use_cache = !$input->getOption('dynamic');

		$this->config->increment($key, $increment, $use_cache);

		$io->success($this->user->lang('CLI_CONFIG_INCREMENT_SUCCESS', $key));
	}


}