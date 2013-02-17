<?php

namespace Acme\DemoBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Fox\TicketingBundle\Api\Api;

/**
 * Simple entity listener
 */
class SimpleEntityListener
{

    /**
     * postPersist event capture
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        $details= (string) $entity->getDetails();

        $entity->setDetails($details . ':'. __FUNCTION__);

        $em->flush($entity);
    }

    /**
     * postUpdate event capture
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        
    }



}

