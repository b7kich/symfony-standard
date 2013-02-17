<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Services\SimpleService;

class SimpleController extends Controller
{

    /**
     * @Route("/", name="_create")
     * @Template()
     */
    public function createAction()
    {

        $em = $this->getDoctrine()->getManager();

        $json= SimpleService::create($em);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
