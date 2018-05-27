<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 01/01/18
 * Time: 19:23
 */

namespace TK\AbonnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TK\AbonnementBundle\Entity\Abonnement;
use TK\AbonnementBundle\Form\AbonnementType;

class AbonnementController extends Controller
{

    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $abonnementRepository = $em->getRepository('TKAbonnementBundle:Abonnement');

        $articles_count = count($abonnementRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_abonnements_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_abonnements' => $abonnementRepository->getList($page,$maxArticles),
            'abonnement'     => 'active',
            'pagination'  => $pagination) ;

        return $this->render('TKAbonnementBundle:Abonnement:all.html.twig',$datas);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;
        $typeAbonnementRepository = $em->getRepository('TKAbonnementBundle:TypeAbonnement') ;
        $etatAbonnementRepository = $em->getRepository('TKAbonnementBundle:EtatAbonnement') ;
        $typeAbonnement = $typeAbonnementRepository->find(1);
        $etatAbonnement = $etatAbonnementRepository->find(1);

        $abonnement = new Abonnement() ;

        $form = $this->get('form.factory')->create(AbonnementType::class,$abonnement) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){

                $etudiant = $abonnement->getProprietaire() ;
                $abonnement->setCleAbonnement("sunnah_". $abonnement->getDebut()->getTimestamp()) ;
                $abonnement->setEtat($etatAbonnement);
                $abonnement->setType($typeAbonnement);
                $em->persist($abonnement);
                $etudiant->addAbonnement($abonnement) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Nouvel abonnement créé.') ;
                return $this->redirectToRoute('tk_abonnements_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'abonnement'     => "active"
        );


        return $this->render('TKAbonnementBundle:Abonnement:add.html.twig',$datas);
    }


}