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


class UtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class)

            ->add('prenom', TextType::class)

            ->add('sexe', EntityType::class,
                array(
                    'class' => 'TKUtilisateurBundle:Genre',
                    'choice_label' => 'libGenre'
                )
            )

            ->add('dateNaissance', DateTimeType::class,
                array(
                    'widget'        => 'single_text',
                    'format'        => 'dd/MM/yyyy'
                ))

            ->add('pays', EntityType::class,
                array(
                    'class'         => 'TKUtilisateurBundle:Pays',
                    'choice_label'  => 'libFr'
            ))

            ->add('email',EmailType::class, array(
                    'constraints' =>[
                        new Email([
                            'message'=>'This is not the correct email format'
                        ]),
                        new NotBlank([
                            'message' => 'This field can not be blank'
                        ])
                    ],
                )
            )

            ->add('mdp',PasswordType::class)

            ->add('role',EntityType::class,
                array(
                    'class'         => 'TKUtilisateurBundle:Grade',
                    'choice_label'  => 'libGrade'
                )
            )

            ->add('abonnementEtat',EntityType::class,
                array(
                    'class'         => 'TKAbonnementBundle:EtatAbonnement',
                    'choice_label'  => 'libEtatFr'
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
            'data_class' => 'TK\UtilisateurBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_utilisateurbundle_utilisateur';
    }


}
