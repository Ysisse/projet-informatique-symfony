<?php


namespace App\Form;


use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Login',
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez votre login"
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe',
                'required' => true,
                'attr' => [
                    'class' => 'monInput',
                    'placeholder' => "Entrez votre mot de passe"
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Connexion'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}