<?php

namespace TK\AbonnementBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use TK\AbonnementBundle\Entity\Abonnement;
use TK\UtilisateurBundle\Entity\Utilisateur;

class SunnahCheckAbonnementCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sunnah:check_abonnement')
            ->setDescription('Cette commande a pour but de mettre à jour les statuts des abonnements des étudiants.')
            ->setHelp("Commande à manier avec précaution : php bin/console sunnah:check_abonnement") ;
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $now = new \DateTime() ;

        $em = $this->getContainer()->get('doctrine') ;
        $logger = $this->getContainer()->get('logger');

        $abonnementRepository = $em->getRepository('TKAbonnementBundle:Abonnement');
        $etatRepository = $em->getRepository('TKAbonnemantBundle:EtatAbonnement');
        $liste_abonnements = $abonnementRepository->findByEtat(1) ;

        $nb = 0 ;
        $total = count($liste_abonnements) ;

        foreach ($liste_abonnements as $abonnement){

            /**
             * @var Abonnement $abonnement
             */

            if($now >= $abonnement->getFin()){

                $nb++ ;

                /**
                 * @var Utilisateur $utilisateur
                 */
                $utilisateur = $abonnement->getOwner() ;

                if($utilisateur){

                    $utilisateur->setAbonnementEtat($etatRepository->find(2)) ;
                    $abonnement->setEtat($etatRepository->find(2)) ;

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Abonnement expiré')
                        ->setFrom('no-reply@sunnah.jeunesse.com')
                        ->setTo($utilisateur->getEmail()) ;
                    $output->writeln("\t + " .$utilisateur->getEmail() . "\n") ;

                    $cid = $message->embed(\Swift_Image::fromPath($this->getContainer()->getParameter('url_image')));

                    $message
                        ->setBody(
                            $this->getContainer()->get('templating')->render(
                                'TKCoreBundle::email_expired_abonnement.html.twig',
                                array('name' => $utilisateur->getPrenom(), 'image' => $cid)
                            ),
                            "text/html"
                        );

                    try{
                        $this->getContainer()->get('mailer')->send($message) ;
                    }
                    catch (Exception $exception){
                        $message = "Un problème est survenu lors de l'envoi de l'alerte de fin d'abonnement à votre adresse mail." ;
                        $logger->info($message);
                    }
                }

            }
        }

        $message = "\t --- Executing sunnah:check_abonnement's command - Entries : $nb/$total - Date : " . date_format($now, 'd-m-Y H:i:s') ;

        $logger->info($message);

        $output->writeln($message) ;

    }

}
