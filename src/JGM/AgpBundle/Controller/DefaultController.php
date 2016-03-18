<?php

namespace JGM\AgpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AgpBundle:Default:index.html.twig');
    }
}
