<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Acme\DemoBundle\Tests\TestDbInit;


class SimpleControllerTest extends WebTestCase
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

    public function testCreate()
    {

        $this->client->request('GET', '/simple/');

        $body=$this->client->getResponse()->getContent();

        $object= \json_decode($body);

        $this->assertTrue(is_object($object), "Failed to decode response:\n". $body);

        $this->assertRegexp('/Acme..DemoBundle..Entity..Simple/', $body);
        $this->assertRegexp('/"id": [0-9]/', $body);
        $this->assertRegexp('/"details": ":postPersist"/',$body);

    }


}
