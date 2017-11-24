<?php

namespace TK\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $data = array('accueil' => 'active') ;
        return $this->render('TKCoreBundle:Default:index.html.twig', $data);
    }
}
