<?php

namespace TK\AbonnementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AbonnementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('debut', DateTimeType::class,
                array(
                    'widget'        => 'single_text',
                    'format'        => 'dd/MM/yyyy'
                )
            )
            ->add('fin', DateTimeType::class,
                array(
                    'widget'        => 'single_text',
                    'format'        => 'dd/MM/yyyy'
                )
            )
            ->add('type', EntityType::class,
                array(
                    'class'         => 'TKAbonnementBundle:TypeAbonnement',
                    'choice_label'  => 'libellePrix'
                )
            )
            ->add('proprietaire', EntityType::class,
                array(
                    'class'         => 'TKUtilisateurBundle:Utilisateur',
                    'choice_label'  => 'email',
                    'multiple'      => false,
                    'attr'          => array(
                                            'class' => 'chosen-select',
                                            'multiple'=>false,
                                            'data-placeholder'=> 'Choisir un étudiant.'
                                    )
                )
            )

            ->add('Enregister',      SubmitType::class) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\AbonnementBundle\Entity\Abonnement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_abonnementbundle_abonnement';
    }


}
