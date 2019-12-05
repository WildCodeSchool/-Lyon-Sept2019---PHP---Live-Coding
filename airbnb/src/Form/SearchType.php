<?php

namespace App\Form;

use App\Entity\House;
use App\Entity\City;
use App\Entity\RentalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', EntityType::class, [
                'required' => false,
                'class' => City::class,
                'choice_label' => 'name',
            ])
            ->add('type', EntityType::class, [
                'required' => false,
                'class' => RentalType::class,
                'choice_label' => 'title',
            ])
            ->add('bedNumber', null, [
                'required' => false,
            ])
            ->add('price', null, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
