<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCli',TextType::class,[
                'label' => "Nom du client"
            ])
            ->add('prenomCli',TextType::class,[
                'label' => "Prénom du client"
            ])
            ->add('contact',TextType::class,[])
           
            ->add('addresseCli',TextType::class,[
                'label' => "Adresse"
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
            'data_class' => Client::class,
        ]);
    }
}
