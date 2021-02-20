<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Materiel;
use App\Entity\Departement;
use App\Entity\SousType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qte',IntegerType::class,[
                'label' => "Quantité",
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('dateApprovisionnement',DateType::class,[
                'label' => "Date d'approvisionnement",
                'widget' => "single_text"
            ])
            ->add('designation',TextType::class,[
                'label' => "Désignation"
            ])
            ->add('prixUnitaire',IntegerType::class,[
                'label' => "Prix unitaire",
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('type',EntityType::class,[
                'class' => Type::class,
                'choice_label' => "descrType",
                "mapped" => false
            ])
            ->add('departement',EntityType::class,[
                'class' => Departement::class,
                'choice_label' => "nomDepartement",
            ])
        ;
        
        $builder->get('type')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event)
            {
                // dd($event);
                $form = $event->getForm();
                // dd($form);

                $form->getParent()->add('sousType',EntityType::class,[
                    'class' => SousType::class,
                    'choice_label' => "descrSousType"
                    // 'choices' => $form->getData()->getSousTypes()
                ]);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
