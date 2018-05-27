<?php

namespace TK\CoursBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre', TextType::class)

            ->add('description', TextareaType::class)

            ->add('file',FileType::class,array(
                'data_class'    => null,
                'required'      => false
            ))

            ->add('format',EntityType::class,
                array(
                    'class'         => 'TKCoursBundle:Format',
                    'choice_label'  => 'libFormat'
                )
            )

            ->add('theme',EntityType::class,
                array(
                    'class'         => 'TKCoursBundle:Theme',
                    'choice_label'  => 'libelle'
                )
            )

            ->add('acces',EntityType::class,
                array(
                    'class'         => 'TKCoursBundle:Accessibilite',
                    'choice_label'  => 'libAccessibilite'
                )
            )

            ->add('mois',EntityType::class,
                array(
                    'class'         => 'TKCoursBundle:Mois',
                    'choice_label'  => 'libFr'
                )
            )

            ->add('ajoutePar',EntityType::class,
                array(
                    'class'         => 'TKUtilisateurBundle:Utilisateur',
                    'choice_label'  => 'nomPrenom',
                )
            )

            ->add('dateAjout',DateTimeType::class,
                array(
                    'widget'        => 'single_text',
                    'format'        => 'dd/MM/yyyy'
                )
            )

            ->add('Enregistrer',      SubmitType::class) ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\CoursBundle\Entity\Cours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_coursbundle_cours';
    }


}
