<?php
namespace Reense\ConsoleCommand;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command {

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName("hello")->setDescription("An example hello Command");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello world!");

    }

}