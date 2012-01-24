<?php
namespace Bkg\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InfoCommand extends Command
{
	protected function configure()
	{
		$this
		->setName('info')
		->setDescription('show current git information')
		->setHelp("")
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$path = \Git2\Repository::discover($_SERVER['PWD']);
		
		if (!empty($path)) {
			$repository = new \Git2\Repository($path);
			$config = new \Git2\Config($path . "/config");
			//$output->writeln(print_r($config,true));
			if ($remote = $config->get("remote.origin")) {
				$output->writeln(sprintf("origin: %s\n", $remote['url']));
			}
		} else {
			$output->writeln("could not find .git path.");
		}
	}
}