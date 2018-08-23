<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer votre n,om d\'utilisateur'
                    ])
                ]
            ])
            ->add('mail', TextType::class, [
                'label' => 'Adresse mail',
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer une adresse e-mail'
                    ])
                ]
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Objet',
                'required' => false,
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer un objet'
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer votre message'
                    ])
                ]
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
