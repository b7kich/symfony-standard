<?php


namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Simple entity for testing lifecycle callbacks
 *
 * @ORM\Table(name="simple")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\SimpleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Simple
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="details", type="text", nullable=true)
     */
    private $details;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->details=null;
     }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set details
     *
     * @param string $details
     * @return Ticket
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

}
