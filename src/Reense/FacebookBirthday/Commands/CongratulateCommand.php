<?php


namespace Reense\FacebookBirthday\Commands;




use Reense\FacebookBirthday\Drivers\FacebookDriver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CongratulateCommand extends FacebookCommand
{

    private $facebookDriver;

    public function __construct($name = null)
    {
        parent::__construct($name);

    }

    protected function configure()
    {
        $this->setName("congratulate")
             ->setDescription("Congratulate people whos birthday it is today")
             ->addArgument('email', InputArgument::REQUIRED, 'Your Facebook login password.')
             ->addArgument('password', InputArgument::REQUIRED, 'Your Facebook login password.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->facebookDriver = new FacebookDriver;



        if($this->facebookDriver->loginWithCredentials($input->getArgument('email'), $input->getArgument('password'))) {
            $this->facebookDriver->navigateToBirthdays();
            $this->facebookDriver->congratulateAll();
        }



    }
}