<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_users')
            ->add('firstname_users')
            ->add('phone_number_users')
            ->add('mail')
            ->add('password_users', PasswordType::class, [
                'mapped' => false,
                // protection entité password
                // test si mot de passe  n'est pas dans une base de données publiques
                'constraints' => [new NotCompromisedPassword()]
            ])
            ->add('retype_password_users', PasswordType::class)
            ->add('role');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'translation_domain' => 'forms'
        ]);
    }
}
