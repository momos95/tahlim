<?php

namespace TK\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use TK\CoursBundle\Entity\Cours;
use TK\CoursBundle\Entity\Theme;
use TK\CoursBundle\Form\CoursEditType;
use TK\CoursBundle\Form\CoursType;
use TK\CoursBundle\Form\ThemeType;

class ThemeController extends Controller
{
    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $coursRepository = $em->getRepository('TKCoursBundle:Theme');

        $articles_count = count($coursRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_cours_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_themes' => $coursRepository->getList($page,$maxArticles),
            'cours'     => 'active',
            'pagination'  => $pagination) ;

        return $this->render('TKCoursBundle:Theme:all.html.twig',$datas);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;
        $theme = new Theme() ;

        $form = $this->get('form.factory')->create(ThemeType::class,$theme) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){

                $em->persist($theme) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Théme bien enregistré.') ;
                return $this->redirectToRoute('tk_cours_theme_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'cours'     => 'active'
        );


        return $this->render('TKCoursBundle:Theme:add.html.twig',$datas);

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $themeRepository = $em->getRepository('TKCoursBundle:Theme');
        $theme = $themeRepository->find($id) ;

        $form = $this->get('form.factory')->create(ThemeType::class,$theme) ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Théme bien sauvegardé.') ;
                return $this->redirectToRoute('tk_cours_theme_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'cours'     => 'active'
        );


        return $this->render('TKCoursBundle:Theme:edit.html.twig',$datas);
    }

    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $themeRepository = $em->getRepository('TKCoursBundle:Theme');
        $theme = $themeRepository->find($id) ;
        $em->remove($theme);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Théme bien supprimé.') ;
        return $this->redirectToRoute('tk_cours_theme_homepage') ;

    }
}
