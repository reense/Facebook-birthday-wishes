<?php
/**
 * Created by PhpStorm.
 * User: reense
 * Date: 23/07/2017
 * Time: 16:55
 */

namespace Reense\FacebookBirthday\Commands;


use Symfony\Component\Console\Command\Command;

class FacebookCommand extends  Command
{

    protected $output;

    public function __construct($name = null)
    {
        parent::__construct($name);
    }


    protected function comment($msg) {
        $this->output->writeln("<comment>$msg</comment>");
    }


    protected function success($msg) {
        $this->output->writeln("<info>$msg</info>");
    }

    protected function error($msg) {
        $out = $this->output->writeln("<error>$msg</error>");

    }
}