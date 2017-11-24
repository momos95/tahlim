<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 20/11/17
 * Time: 18:41
 */

namespace TK\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response ;
use TK\UtilisateurBundle\Entity\Utilisateur;
use TK\UtilisateurBundle\Form\UtilisateurType;

class UtilisateurController extends Controller
{
    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $utilisateursRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $articles_count = count($utilisateursRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_utilisateur_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_users' => $utilisateursRepository->getList($page,$maxArticles),
            'utilisateur'     => 'active',
            'pagination'  => $pagination) ;

        return $this->render('TKUtilisateurBundle:Utilisateur:all.html.twig',$datas);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;
        $utilisateur = new Utilisateur();
        $form = $this->get('form.factory')->create(UtilisateurType::class,$utilisateur) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){
                $utilisateur->setMdp(sha1($utilisateur->getMdp())) ;
                $em->persist($utilisateur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Utilisateur bien enregistré.') ;
                return $this->redirectToRoute('tk_utilisateur_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'utilisateur'     => 'active'
        );


        return $this->render('TKUtilisateurBundle:Utilisateur:add.html.twig',$datas);

    }

    public function viewAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;

        $utilisateursRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $utilisateur = $utilisateursRepository->find($id);

        $form = $this->get('form.factory')->create(UtilisateurType::class,$utilisateur) ;

        $mdp = $utilisateur->getMdp() ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                $utilisateur->setMdp($mdp) ;

                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Utilisateur bien enregistré.') ;

                return $this->redirectToRoute('tk_utilisateur_view',array('id' =>$id)) ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'utilisateur'     => 'active'
        );


        return $this->render('TKUtilisateurBundle:Utilisateur:viewEdit.html.twig',$datas);
    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;

        $utilisateursRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $utilisateur = $utilisateursRepository->find($id);

        $em->remove($utilisateur);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'L\'utilisateur a été supprimé.') ;

        return $this->redirectToRoute('tk_utilisateur_homepage') ;

    }


}