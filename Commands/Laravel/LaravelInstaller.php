<?php

namespace JCA\Commands\Laravel;

// src/Command/CreateUserCommand.php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LaravelInstaller extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('laravel:new')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new laravel project.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('create new laravel project')
            ->addArgument('destination', InputArgument::REQUIRED, 'where to install ??')
            ->addArgument('project_name', InputArgument::REQUIRED, 'project name ??')
            ->addOption('install-jlib', "il", InputOption::VALUE_OPTIONAL, 'install jlib');


    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $this->installTo($input, $output);

        if ($input->getOption("install-jlib") == "true")
            $this->installJlib($input, $output);

    }

    private function installTo(InputInterface $input, OutputInterface $output)
    {

        $output->writeln([
            'project creating, please wait',
            '============',
            '',
        ]);

        $projectDestination = $input->getArgument("destination");
        $projectName = $input->getArgument("project_name");
        $output->writeln(exec("cd $projectDestination && composer create-project --prefer-dist laravel/laravel $projectName"));
        $output->writeln("init .env file");
        $output->writeln(exec("cd $projectDestination/$projectName && cp .env.example .env  && php artisan key:generate &&"));

    }

    private function installJlib(InputInterface $input, OutputInterface $output)
    {

        $projectDestination = $input->getArgument("destination");
        $projectName = $input->getArgument("project_name");

        $command = $this->getApplication()->find('laravel:install-jlib');

        $command->run(
            new ArrayInput(
                [
                    'command' => "laravel:install-jlib",
                    'destination' => "$projectDestination/$projectName",
                ]
            ),
            $output
        );

    }

}