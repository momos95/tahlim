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

class EtudiantController extends Controller
{
    public $etudiantsActive = "active" ;

    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $etudiantsRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $articles_count = count($etudiantsRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_etudiant_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_users' => $etudiantsRepository->getListEtudiant($page,$maxArticles),
            'etudiant'     => $this->etudiantsActive ,
            'pagination'  => $pagination) ;

        return $this->render('TKUtilisateurBundle:Etudiant:all.html.twig',$datas);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;
        $etudiant = new Utilisateur();
        $form = $this->get('form.factory')->create(UtilisateurType::class,$etudiant) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){
                $etudiant->setMdp(sha1($etudiant->getMdp())) ;
                $em->persist($etudiant) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Etudiant bien enregistré.') ;
                return $this->redirectToRoute('tk_etudiant_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'etudiant'     => $this->etudiantsActive
        );


        return $this->render('TKUtilisateurBundle:Etudiant:add.html.twig',$datas);

    }

    public function viewAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;

        $etudiantsRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $etudiant = $etudiantsRepository->find($id);

        $form = $this->get('form.factory')->create(UtilisateurType::class,$etudiant) ;

        $mdp = $etudiant->getMdp() ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                $etudiant->setMdp($mdp) ;

                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Etudiant bien enregistré.') ;

                return $this->redirectToRoute('tk_etudiant_view',array('id' =>$id)) ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'etudiant'     => $this->etudiantsActive
        );


        return $this->render('TKUtilisateurBundle:Etudiant:viewEdit.html.twig',$datas);
    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;

        $etudiantsRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $etudiant = $etudiantsRepository->find($id);

        $em->remove($etudiant);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'L\'étudiant a été supprimé.') ;

        return $this->redirectToRoute('tk_etudiant_homepage') ;

    }


}