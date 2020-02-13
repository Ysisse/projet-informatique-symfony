<?php

namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, [
                'label' => 'Intitulé',
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez un intitulé d'un module"
                ]
            ])
            ->add('nb_H_CM', IntegerType::class, [
                'label' => "Nombres d'heures de CM",
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez un nombre d'heures de CM"
                ]
            ])
            ->add('nb_H_TD', IntegerType::class, [
                'label' => "Nombres d'heures de TD",
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez un nombre d'heures de TD"
                ]
            ])
            ->add('nb_H_TP', IntegerType::class, [
                'label' => "Nombres d'heures de TP",
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez un nombre d'heures de TP"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
