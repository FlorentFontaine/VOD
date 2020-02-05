<?php

namespace App\Form;

use App\Entity\MovieSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MovieSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class ,  ['label' => false, 'attr' => ['placeholder' => 'Titre']])
            ->add('acteur', TextType::class , ['label' => false, 'attr' => ['placeholder' => 'Acteur']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MovieSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }
}
