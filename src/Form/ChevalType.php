<?php

namespace App\Form;
use App\Entity\RaceDeCheval;
use App\Entity\Client;
use App\Entity\Cheval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
                ->add('prixDeDepart', IntegerType::class, [
                    'label' => 'Prix de depart (en €)',
                ])
            //->add('client', EntityType::class, array('class' => 'App\Entity\Client','choice_label' => 'Client' ))
            
            ->add('race', EntityType::class, array('class' => 'App\Entity\RaceDeCheval','choice_label' => 'libellle' ))
           // ->add('image', FileType::class,[ 'image' ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheval::class,
        ]);
    }
}
