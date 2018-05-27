<?php

namespace TK\RecitationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecitateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('genre', EntityType::class,
                array(
                'class' => 'TKUtilisateurBundle:Genre',
                'choice_label' => 'libGenre'
                )
            )
            ->add('categorie', EntityType::class,
                array(
                    'class' => 'TKRecitationBundle:CategorieRecitateur',
                    'choice_label' => 'libelle'
                )
            )
            ->add('imgProfil', FileType::class,
                array(
                    'data_class'    => null
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
            'data_class' => 'TK\RecitationBundle\Entity\Recitateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_recitationbundle_recitateur';
    }


}
