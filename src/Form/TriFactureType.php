<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TriFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFacture',DateType::class,[
                'label' => "Date de facturation",
                'widget' => "single_text"
            ])
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
            // Configure your form options here
        ]);
    }
}
