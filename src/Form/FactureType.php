<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Facture;
use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client',EntityType::class,[
                'class' => Client::class,
                'choice_label' => "fullName",
            ])
            ->add('materiel',EntityType::class,[
                'class' => Materiel::class,
                'choice_label' => "designation",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
