<?php

namespace TK\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TKCoursBundle:Default:index.html.twig');
    }
}
