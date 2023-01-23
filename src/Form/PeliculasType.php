<?php

namespace App\Form;

use App\Entity\Peliculas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PeliculasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('sinopsis')
            ->add('imagen',FileType::class)
            ->add('genero')
            ->add('precio',IntegerType::class)
            ->add('duracion',IntegerType::class)
            ->add('lanzamiento',DateType::class)
            ->add('Adicionar',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Peliculas::class,
        ]);
    }
}
