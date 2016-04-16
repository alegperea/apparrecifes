<?php

namespace JGM\AgpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AgpBundle:Producto')->findAll(); 
        return $this->render('AgpBundle:Default:index.html.twig', array(
		  'entities' => $entities
        ));
    }
}
