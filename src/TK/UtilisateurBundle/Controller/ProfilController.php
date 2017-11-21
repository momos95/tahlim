<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 21/11/17
 * Time: 07:07
 */

namespace TK\UtilisateurBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TK\UtilisateurBundle\Entity\Utilisateur;
use TK\UtilisateurBundle\Form\ProfilType;
use TK\UtilisateurBundle\Form\UtilisateurType;

class ProfilController extends Controller
{
    public function editAction(Request $request){

        $id = $this->getUser()->getId() ;

        $em = $this->getDoctrine()->getManager() ;

        $utilisateursRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur');

        $utilisateur = $utilisateursRepository->find($id);

        $mdp = $utilisateur->getMdp() ;

        $form = $this->get('form.factory')->create(ProfilType::class,$utilisateur) ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                if(empty($utilisateur->getMdp()))
                    $utilisateur->setMdp($mdp) ;

                else
                    $utilisateur->setMdp(sha1($utilisateur->getMdp())) ;

                $em->persist($utilisateur) ;

                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Données bien sauvegardées.') ;

                return $this->redirectToRoute('tk_profile_edit') ;
            }
        }

        $datas = array(
            'form'          => $form->createView()
        );


        return $this->render('TKUtilisateurBundle:Profil:view.html.twig',$datas);
    }
}