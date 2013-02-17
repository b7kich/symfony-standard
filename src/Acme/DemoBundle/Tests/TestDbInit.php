<?php

namespace Acme\DemoBundle\Tests;

use Doctrine\ORM\Tools\SchemaTool;

/**
 * Test Database setup methods
 */
trait TestDbInit
{

    /**
     * @var SchemaTool
     */
    protected $schemaTool;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;
    protected $classes;


    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    /**
     * Set up our "in memory" docrtine ORM data model.
     */
    protected function init()
    {

        $this->client = static::createClient();

        $container = $this->getContainer();

        $this->doctrine = $container->get('doctrine');

        $this->em = $this->doctrine->getEntityManager();

        $mdf = $this->em->getMetaDataFactory();
        $this->classes = $mdf->getAllMetadata();

        $this->schemaTool = new SchemaTool($this->em);
        $this->schemaTool->dropDatabase();
        $this->schemaTool->createSchema($this->classes);

        $this->createSimple($this->em);

        $this->em->flush();
        $this->em->clear();
    }

    protected function createSimple($em) {
        $entity = new \Acme\DemoBundle\Entity\Simple();
        $this->em->persist($entity);
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Doctrine\Bundle\DoctrineBundle\Registry
     *
     * @throws Exception If DoctrineBundle is not available
     */
    public function getDoctrine()
    {
        return $this->get('doctrine');
    }

    /**
     * Get a service from the container
     *
     * @param string $key
     * @return mixed
     */
    protected function get($key)
    {
        return static::$kernel->getContainer()->get($key);
    }

    /**
     * @return Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer()
    {
        return static::$kernel->getContainer();
    }

}
