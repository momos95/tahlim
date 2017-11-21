<?php

namespace TK\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoursController extends Controller
{
    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $coursRepository = $em->getRepository('TKCoursBundle:Cours');

        $articles_count = count($coursRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_cours_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_cours' => $coursRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('TKCoursBundle:Cours:all.html.twig',$datas);
    }
}
