<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\SousType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SousTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descrSousType',TextType::class,[
                'label' => "Description"
            ])
            ->add('type',EntityType::class,[
                'class' => Type::class,
                'choice_label' => "descrType",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SousType::class,
        ]);
    }
}
