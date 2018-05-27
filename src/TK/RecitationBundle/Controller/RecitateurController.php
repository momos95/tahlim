<?php

namespace TK\RecitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use TK\RecitationBundle\Entity\Recitateur;
use TK\RecitationBundle\Entity\Sons;
use TK\RecitationBundle\Form\RecitateurEditType;
use TK\RecitationBundle\Form\RecitateurType;
use TK\RecitationBundle\Form\SonsType;

class RecitateurController extends Controller
{
    public function allAction(Request $request, $page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $recitationRepository = $em->getRepository('TKRecitationBundle:Recitateur');

        $articles_count = count($recitationRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_recitation_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_recitateurs'   => $recitationRepository->getList($page,$maxArticles),
            'recitation'    => "active",
            'pagination'    => $pagination
        ) ;

        return $this->render('TKRecitationBundle:Recitateur:all.html.twig',$datas);
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $recitateur = new Recitateur() ;
        $form = $this->get('form.factory')->create(RecitateurType::class,$recitateur) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
                 */
                $fichier = $recitateur->getImgProfil() ;

                $filename = md5(uniqid()). '.' . $fichier->guessExtension() ;
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/images' ;
                $fichier->move($imagesDir,$filename) ;
                $recitateur->setImgProfil($filename) ;
                $em->persist($recitateur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Récitateur bien enregistré.') ;
                return $this->redirectToRoute('tk_recitation_homepage') ;
            }
        }


        $datas = array(
            'form'   => $form->createView(),
            'recitation'    => "active"
        ) ;

        return $this->render('TKRecitationBundle:Recitateur:add.html.twig',$datas);
    }

    public function viewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $recitationRepository = $em->getRepository('TKRecitationBundle:Recitateur');
        $sound = new Sons() ;
        $formSound = $this->get('form.factory')->create(SonsType::class,$sound,array(
            'action'    => $this->generateUrl('tk_recitation_addsound',array('id' => $id))
        ))  ;
        /**
         * @var Recitateur $recitateur
         */
        $recitateur = $recitationRepository->find($id) ;
        $sound->setRecitateur($recitateur) ;
        $ancienImage = $recitateur->getImgProfil() ;
        $nbPistes = $recitateur->getNbrPistes();

        $filesystem = new Filesystem() ;

        $form = $this->get('form.factory')->create(RecitateurEditType::class,$recitateur) ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $imgProfil
                 */
                $imgProfil = $recitateur->getImgProfil();


                if($imgProfil != null){
                    $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/images/'.$ancienImage);
                    $filename = md5(uniqid()). '.' . $imgProfil->guessExtension() ;
                    $imgDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/images' ;
                    $imgProfil->move($imgDir,$filename) ;
                    $recitateur->setImgProfil($filename) ;
                }
                else{
                    $recitateur->setImgProfil($ancienImage) ;
                }
                $recitateur->setNbrPistes($nbPistes) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Récitateur bien sauvegardé.') ;
                return $this->redirectToRoute('tk_recitation_homepage') ;
            }
        }

        $datas = array(
            'form'   => $form->createView(),
            'formSound' => $formSound->createView(),
            'recitation'    => "active",
            'recitateur'    => $recitateur,
            'soundsUrl'     =>"uploads/audios/",
            'imgProfilUrl'       => 'uploads/images/'.$recitateur->getImgProfil(),
        ) ;

        return $this->render('TKRecitationBundle:Recitateur:view.html.twig',$datas);
    }


    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $recitationRepository = $em->getRepository('TKRecitationBundle:Recitateur');
        /**
         * @var Recitateur $recitateur
         */
        $recitateur = $recitationRepository->find($id) ;
        $filesystem = new Filesystem() ;

        if(count($recitateur->getSons()) > 0){
            foreach($recitateur->getSons() as $sound){
                $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/audios/'.$sound->getFichier());
                $em->remove($sound);
            }
        }


        $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/images/'.$recitateur->getImgProfil());

        $em->remove($recitateur) ;

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Le récitateur a été supprimé.') ;

        return $this->redirectToRoute('tk_recitation_homepage') ;
    }

    public function deletesoundAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager() ;
        $soundRepository = $em->getRepository('TKRecitationBundle:Sons');

        /**
         * @var Recitateur $recitateur
         * @var Sons $sound
         */

        $sound = $soundRepository->find($id) ;
        $recitateur = $sound->getRecitateur() ;
        $recitateur->setNbrPistes($recitateur->getNbrPistes()-1);
        $filesystem = new Filesystem() ;
        $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/audios/'.$sound->getFichier());
        $em->remove($sound);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Piste audio supprimée.') ;
        return $this->redirectToRoute('tk_recitation_view', array("id" => $recitateur->getId())) ;

    }

    public function addsoundAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $recitationRepository = $em->getRepository('TKRecitationBundle:Recitateur');
        /**
         * @var Recitateur $recitateur
         */
        $recitateur = $recitationRepository->find($id) ;
        $status = "invalid" ;

        if(!$recitateur){
            $request->getSession()->getFlashBag()->add('warning', 'Action impossible : veuillez contacter l\'administrateur du site.') ;
            return $this->redirectToRoute('tk_recitation_view',array('id'=>$id)) ;
        }

        $sound = new Sons() ;
        $form = $this->createForm(SonsType::class, $sound);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
             */
            $fichier = $sound->getFichier() ;
            $filename = md5(uniqid()). '.' . "mp3" ;
            $soundsDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/audios' ;
            $fichier->move($soundsDir,$filename) ;
            $sound->setFichier($filename) ;
            $sound->setRecitateur($recitateur) ;
            $recitateur->addSon($sound) ;
            $em->persist($sound);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Nouvelle piste sauvegardée.') ;
            return $this->redirectToRoute('tk_recitation_view',array('id'=>$id)) ;
        }

        $request->getSession()->getFlashBag()->add('warning', 'Action impossible : veuillez contacter l\'administrateur du site.') ;
        return $this->redirectToRoute('tk_recitation_view',array('id'=>$id)) ;
    }


}
