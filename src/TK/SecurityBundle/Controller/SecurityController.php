<?php

namespace TK\SecurityBundle\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
    public function loginAction(Request $request){

        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTIFICATED_REMEMBERED') &&
            ($this->getUser() && $this->getUser()->getRole()->getIdGrade() != 3)){
            return $this->redirectToRoute('tk_core_homepage') ;
        }

        $authentificationUtils = $this->get('security.authentication_utils') ;

        $datas = array(
            'last_username'     => $authentificationUtils->getLastUsername() ,
            'error'             => $authentificationUtils->getLastAuthenticationError()
        ) ;

        $content = $this->get('templating')->render('TKSecurityBundle:Security:login.html.twig',$datas) ;

        return new Response($content) ;
    }


    public function forgetAction(Request $request){

        $error = false ;
        $success = false ;
        $message_to_view = "" ;

        $em = $this->getDoctrine()->getManager() ;
        $userRepository = $em->getRepository('TKUtilisateurBundle:Utilisateur') ;

        if($request->isMethod("post")){

            $email=$request->get('email') ;
            $user = $userRepository->findOneByEmail($email) ;

            if($user){

                $mdp = $this->generateRandomString(16) ;
                $user->setMdp(sha1($mdp)) ;
                $em->flush() ;

                $message = \Swift_Message::newInstance()
                    ->setSubject('Mot de passe perdu')
                    ->setFrom('no-reply@sunnah.jeunesse.com')
                    ->setTo($email) ;
                $cid = $message->embed(\Swift_Image::fromPath('bundles/tkcore/images/logo192.png'));
                $message
                    ->setBody(
                        $this->renderView(
                            'TKCoreBundle::email_forget.html.twig',
                            array('name' => $user->getPrenom(),'image_url'   => $cid, 'mdp' => $mdp)
                        ),
                        "text/html"
                    )
                ;

                try{
                    $this->get('mailer')->send($message) ;
                    $success = true ;
                    $message_to_view = "Vous recevrez un mail contenant un mot de passe temporaire qui vous permettra d'accéder à votre compte" ;
                }
                catch (Exception $exception){
                    $error = true ;
                    $message_to_view = "Erreur lors de l'envoie du message." ;

                }
            }
            else{
                $error = true ;
                $message_to_view = "Utilisateur inconnu." ;
            }

        }

        $datas = array(
            'error'             => $error,
            'success'           => $success,
            'message'           => $message_to_view
        ) ;


        $content = $this->get('templating')->render('TKSecurityBundle:Security:forget.html.twig',$datas) ;

        return new Response($content) ;
    }

    public function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#' ;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
