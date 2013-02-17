<?php

namespace Acme\DemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Acme\DemoBundle\Services\SimpleService;

/**
 * Simple test command
 **/
class SimpleCommand extends ContainerAwareCommand
{

    /**
     * Defines command options.
     */
    protected function configure()
    {
        $this
          ->setName('acme:simple-test')
          ->setDescription('Simple test command');
    }

    /**
     * Run command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Executing test...');

        $json= SimpleService::create($this->getContainer()->get('doctrine')->getManager());

        $output->writeln('Result:');

        $output->writeln($json);

    }
}

