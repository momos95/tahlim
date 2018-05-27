<?php

namespace TK\MediaBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('fichier',FileType::class,
                array('data_class'  => null)
            )
            ->add('categorie', EntityType::class,
                array(
                    'class' => 'TKMediaBundle:CategorieMedia',
                    'choice_label' => 'libelle'
                )
            )
            ->add('type', EntityType::class,
                array(
                    'class' => 'TKMediaBundle:TypeMedia',
                    'choice_label' => 'libelle'
                )
            )
            ->add('Ajouter',      SubmitType::class) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\MediaBundle\Entity\Media'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tk_mediabundle_media';
    }


}
