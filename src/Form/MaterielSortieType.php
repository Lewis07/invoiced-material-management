<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\MaterielSortie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MaterielSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qteSortie',IntegerType::class,[
                'label' => "Quantité sortie",
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('dateSortie',DateType::class,[
                'label' => "Date d'approvisionnement",
                'widget' => "single_text"
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
            'data_class' => MaterielSortie::class,
        ]);
    }
}
