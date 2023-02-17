<?php

namespace App\Form;
use App\Entity\RaceDeCheval;
use App\Entity\Cheval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ChevalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
        ])
        ->add('sire', IntegerType::class, [
            'label' => 'Sire',
        ])
            ->add('sexe', TextType::class, [
                'label' => 'Sexe',
                ])
                ->add('prix_de_depart', IntegerType::class, [
                    'label' => 'Prix de depart (en €)',
                ])
            ->add('client')
            ->add('race', TextType::class, [
                'label' => 'Race',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheval::class,
        ]);
    }
}
