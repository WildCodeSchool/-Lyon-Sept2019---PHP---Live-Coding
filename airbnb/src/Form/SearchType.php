<?php

namespace App\Form;

use App\Entity\House;
use App\Entity\City;
use App\Entity\RentalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

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
            // ->add('bedNumber', null, [
            //     'required' => false,
            // ])
            ->add('price', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    '> 75 €' => '75,-1',
                    '50-75 €' => '50,75',
                    '25-50 €' => '25,50',
                    '< 25 €' => '0,25',
                ],
            ])
        ;

        $builder->get('price')
            ->addModelTransformer(new CallbackTransformer(
                function ($var) {
                    return $var;
                },
                function ($var) {
                    return explode(',', $var);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
