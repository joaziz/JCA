<?php

namespace JCA\Commands\Laravel;

// src/Command/CreateUserCommand.php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InstallJlib extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('laravel:install-jlib')
            // the short description shown while running "php bin/console list"
            ->setDescription('install jlib for project')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('create new laravel project')
            ->addArgument('destination', InputArgument::REQUIRED, 'where to install ??');


    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


         $this->installTo($input, $output);


    }

    private function installTo(InputInterface $input, OutputInterface $output)
    {

        $output->writeln(["Project create now will install 'JLIP' package", "----------------------------------------------", ""]);

        $projectDestination = $input->getArgument("destination");

        $output->writeln(exec("cd $projectDestination && composer require jlib/base"));

        $output->writeln(["thank you", "--------",]);
    }




}