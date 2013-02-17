<?php

namespace Acme\DemoBundle\Services;

use Acme\DemoBundle\Entity\Simple;
use Doctrine\Common\Util\Debug;

/**
 * Simple test service
 */
class SimpleService
{

    /**
     * Create and persist new Simple entity.
     *
     * @return string
     */
    public static function create($em)
    {

        $entity = new Simple();

        $em->persist($entity);
        $em->flush();

        $data = Debug::export($entity, 2);

        return \json_encode($data, JSON_PRETTY_PRINT);
    }

}
