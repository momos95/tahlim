<?php

namespace TK\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
    public function loginAction(Request $request){

        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTIFICATED_REMEMBERED')){
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


    public function forgetAction(){

        $datas = array(
            'error'             => false
        ) ;

        $content = $this->get('templating')->render('TKSecurityBundle:Security:forget.html.twig',$datas) ;

        return new Response($content) ;
    }

}
