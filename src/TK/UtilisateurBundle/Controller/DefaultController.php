<?php

namespace TK\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TKUtilisateurBundle:Default:index.html.twig');
    }
}
