<?php

namespace TK\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use TK\MediaBundle\Entity\Media;
use TK\MediaBundle\Form\MediaEditType;
use TK\MediaBundle\Form\MediaType;

class MediathequeController extends Controller
{
    public function allAction($page)
    {

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $mediaRepository = $em->getRepository('TKMediaBundle:Media');

        $articles_count = count($mediaRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'tk_media_homepage',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_medias'   => $mediaRepository->getList($page,$maxArticles),
            'media'         => 'active',
            'videosUrl'     => "uploads/medias/",
            'pagination'    => $pagination) ;

        return $this->render('TKMediaBundle:Mediatheque:all.html.twig', $datas);
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $media = new Media();
        $form = $this->get('form.factory')->create(MediaType::class,$media) ;

        if($request->isMethod(('POST'))){
            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
                 */
                $fichier = $media->getFichier();

                $filename = md5(uniqid()). '.' . $fichier->guessExtension() ;
                $mediasDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/medias' ;
                $fichier->move($mediasDir,$filename) ;
                $media->setFichier($filename) ;
                $media->setAuteur($this->getUser()) ;
                $em->persist($media) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Vidéo bien enregistrée.') ;
                return $this->redirectToRoute('tk_media_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'media'         => 'active'
        );

        return $this->render('TKMediaBundle:Mediatheque:add.html.twig',$datas);
    }

    public function viewAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $mediaRepository = $em->getRepository('TKMediaBundle:Media');
        /**
         * @var Media $media
         */
        $media = $mediaRepository->find($id) ;
        $ajouterPar = $media->getAuteur();
        $ancienFile = $media->getFichier() ;
        $filesystem = new Filesystem() ;

        $form = $this->get('form.factory')->create(MediaEditType::class,$media) ;

        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){

                /**
                 * @var Symfony\Component\HttpFoundation\File\UploadedFile $fichier
                 */
                $fichier = $media->getFichier() ;

                if($fichier != null){
                    $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/medias/'.$ancienFile);
                    $filename = md5(uniqid()). '.' . $fichier->guessExtension() ;
                    $mediasDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/medias' ;
                    $fichier->move($mediasDir,$filename) ;
                    $media->setFichier($filename) ;
                }
                else{
                    $media->setFichier($ancienFile) ;
                }
                $media->setAuteur($ajouterPar);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Média bien sauvegardé.') ;
                return $this->redirectToRoute('tk_media_homepage') ;
            }
        }

        $datas = array(
            'form'          => $form->createView(),
            'media'     => 'active'
        );


        return $this->render('TKMediaBundle:Mediatheque:view.html.twig',$datas);
    }

    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager() ;
        $mediaRepository = $em->getRepository('TKMediaBundle:Media');
        /**
         * @var Media $media
         */
        $media = $mediaRepository->find($id) ;
        $filesystem = new Filesystem() ;
        $filesystem->remove($this->container->getParameter('kernel.root_dir').'/../web/uploads/medias/'.$media->getFichier());
        $em->remove($media);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'La vidéo a bien été supprimée.') ;
        return $this->redirectToRoute('tk_media_homepage') ;

    }

}
