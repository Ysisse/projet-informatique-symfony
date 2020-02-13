<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Groupe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Entity\Salle;
use App\Entity\TypeCours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Date',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => [
                    'year' => 'Années', 'month' => 'Mois', 'day' => 'Jours',
                ],
                'attr' => [
                    'class' => 'monInput'
                ]
            ])
            ->add('heureDebut', TimeType::class, [
                'label' => 'Heure de début',
                'input'  => 'datetime',
                'widget' => 'single_text',
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'attr' => [
                    'class' => 'monInput'
                ]
            ])
            ->add('heureFin', TimeType::class, [
                'label' => 'Heure de fin',
                'input'  => 'datetime',
                'widget' => 'single_text',
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'attr' => [
                    'class' => 'monInput'
                ]
            ])
            ->add('module', EntityType::class, [
                'label' => 'Module',
                'class' => Module::class,
                'choice_label' => "intitule",
                'choice_value' => 'id',
                'required' => true,
                'placeholder' => '',
                'attr' => [
                    'class' => 'monInput'
                ]
            ])
            ->add('typeCours', EntityType::class, [
                'label' => 'Type de cours',
                'class' => TypeCours::class,
                'choice_label' => "intitule",
                'choice_value' => 'id',
                'required' => true,
                'expanded' => true
            ])
            ->add('salle', EntityType::class, [
                'label' => 'Salle',
                'class' => Salle::class,
                'choice_label' => "intitule",
                'choice_value' => 'id',
                'required' => true,
                'placeholder' => '',
                'attr' => [
                    'class' => 'monInput monInputSerialize'
                ]

            ])
            ->add('groupes', EntityType::class, [
                'label' => 'Groupe(s)',
                'class' => Groupe::class,
                'choice_label' => "intitule",
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ])
            ->add('professeurs', EntityType::class, [
                'label' => 'Professeur(s)',
                'class' => Professeur::class,
                'choice_label' => "nom",
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => false,
                'required' => true,
                'placeholder' => 'Choisis un ou plusieurs professeurs',
                'attr' => [
                    'class' => 'monInput monInputSerialize'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
