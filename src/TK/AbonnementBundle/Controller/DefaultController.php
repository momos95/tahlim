<?php

namespace TK\AbonnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TKAbonnementBundle:Default:index.html.twig');
    }
}
