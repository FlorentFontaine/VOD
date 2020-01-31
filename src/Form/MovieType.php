<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('temps')
            ->add('nb_episode')
            ->add('acteur')
            ->add('realisateur')
            ->add('musique')
            ->add('vu')
            ->add('genre', choiceType::class, ['choices'=> $this->getChoice()])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }

    private function getChoice(){
        $choice = Movie::GENRE;
        $output= [];
        foreach ($choice as $k => $v) {
            $output[$v] = $k;
        }
        return $output;

    }
}
