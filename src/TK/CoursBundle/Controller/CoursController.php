<?php

namespace TK\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use TK\CoursBundle\Entity\Cours;
use TK\CoursBundle\Form\CoursEditType;
use TK\CoursBundle\Form\CoursType;

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

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;
        $cours = new Cours() ;
        $form = $this->get('form.factory')->create(CoursType::class,$cours) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
                 */
                $fichier = $cours->getFile() ;

                $filename = md5(uniqid()). '.' . $fichier->guessExtension() ;
                $coursDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cours' ;
                $fichier->move($coursDir,$filename) ;
                $cours->setFile($filename) ;
                $cours->setAjoutePar($this->getUser()) ;
                $em->persist($cours) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Cours bien enregistré.') ;
                return $this->redirectToRoute('tk_cours_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView()
        );


        return $this->render('TKCoursBundle:Cours:add.html.twig',$datas);

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $coursRepository = $em->getRepository('TKCoursBundle:Cours');
        $cours = $coursRepository->find($id) ;
        $ajouterPar = $cours->getAjoutePar();
        $dateAjout = $cours->getDateAjout();
        $ancienFile = $cours->getFile() ;
        $filesystem = new Filesystem() ;

        $form = $this->get('form.factory')->create(CoursEditType::class,$cours) ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
                 */
                $fichier = $cours->getFile() ;

                if($fichier != null){
                    $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/cours/'.$ancienFile);
                    $filename = md5(uniqid()). '.' . $fichier->guessExtension() ;
                    $coursDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cours' ;
                    $fichier->move($coursDir,$filename) ;
                    $cours->setFile($filename) ;
                }
                else{
                    $cours->setFile($ancienFile) ;
                }
                $cours->setAjoutePar($ajouterPar);
                $cours->setDateAjout($dateAjout) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Cours bien enregistré.') ;
                return $this->redirectToRoute('tk_cours_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView()
        );


        return $this->render('TKCoursBundle:Cours:edit.html.twig',$datas);
    }

    public function viewAction($id){
        $em = $this->getDoctrine()->getManager() ;
        $coursRepository = $em->getRepository('TKCoursBundle:Cours');
        $cours = $coursRepository->find($id) ;
        $datas = array(
            'cours'     => $cours,
            'url'       => 'uploads/cours/'.$cours->getFile()
        );
        return $this->render('TKCoursBundle:Cours:view.html.twig',$datas);
    }

    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $coursRepository = $em->getRepository('TKCoursBundle:Cours');
        $cours = $coursRepository->find($id) ;
        $filesystem = new Filesystem() ;
        $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/cours/'.$cours->getFile());
        $em->remove($cours);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Cours bien supprimé.') ;
        return $this->redirectToRoute('tk_cours_homepage') ;


    }
}
