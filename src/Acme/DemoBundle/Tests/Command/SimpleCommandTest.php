<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Bundle\FrameworkBundle\Client;

use Acme\DemoBundle\Tests\TestDbInit;


 class SimpleCommandTest extends WebTestCase
 {

     use TestDbInit;

    /**
     * Set up
     */
    protected function setUp()
    {
        parent::setUp();
        $this->init();
    }

     public function testRun()
     {

         $body = $this->runCommand($this->client, "acme:simple-test");

        $this->assertRegexp('/Acme..DemoBundle..Entity..Simple/', $body);
        $this->assertRegexp('/"id": [0-9]/', $body);
        $this->assertRegexp('/"details": ":postPersist"/',$body);

   }


    /**
     * Runs a command and returns it output
     * @author Alexandre Salomé <alexandre.salome@gmail.com>
     */
    public function runCommand(Client $client, $command)
    {
        $application = new Application($client->getKernel());
        $application->setAutoExit(false);

        $fp = tmpfile();
        $input = new StringInput($command);
        $output = new StreamOutput($fp);

        $application->run($input, $output);

        unset ($output);

        fseek($fp, 0);
        $buffer = '';
        while (!feof($fp)) {
            $buffer = fread($fp, 4096);
        }
        fclose($fp);

        return $buffer;
    }

 }