<?php

namespace TK\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;


class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder


            ->add('nom', TextType::class,array(
                'required'      => false
            ))


            ->add('prenom', TextType::class,array(
                'required'      => false
            ))


            ->add('sexe', EntityType::class,
                array(
                    'class' => 'TKUtilisateurBundle:Genre',
                    'choice_label' => 'libGenre'
                )
            )

            ->add('email',EmailType::class, array(
                    'required'  => false
                )
            )

            ->add('abonnementEtat',EntityType::class,
                array(
                    'class'         => 'TKAbonnementBundle:EtatAbonnement',
                    'choice_label'  => 'libEtatFr'
                )
            )


            ->add('pays', EntityType::class,
                array(
                    'class'         => 'TKUtilisateurBundle:Pays',
                    'choice_label'  => 'libFr',
                    'data'          => ''
                ))


            ->add('Filtrer',      SubmitType::class) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\UtilisateurBundle\Entity\Search'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_utilisateurbundle_search';
    }


}
