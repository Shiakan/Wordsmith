<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom de l\'utilisateur'
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    New Email([
                        'mode' => 'html5'
                    ])
                ]  
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
                // On récupère le formulaire en cours de validation
                $user = $event->getData();
                $userForm = $event->getForm();
                //Si l'ID de l'user est null, on est en mode création d'un utilisateur
                if(is_null($user->getId())){
                    $userForm->add('password', RepeatedType::class, [
                        'type' => PasswordType::class,
                        'constraints' => [ 
                            New NotBlank([
                                'message' => 'Veuillez entrer votre mot de passe'
                            ]),
                            New Length([
                                'min' => 8,
                                'max' => 16,
                                'minMessage' => 'Votre mot de passe doit faire au minimum 8 caractères',
                                'maxMessage' => 'Votre mot de passe doit faire au maximum 16 caractères'
                            ])
                        ],
                        'invalid_message' => 'Les mots de passe ne sont pas identiques',
                        'options' => [
                            'attr' => [
                                'class' => 'password-field'
                            ]
                        ],
                        'required' => true,
                        'first_options' => [
                            'label' => 'Tapez votre mot de passe'
                        ],
                        'second_options' => [
                            'label' => 'Répétez votre mot de passe'
                        ],
                        'required' => true 
                        ]);
                } else {
                    // Si l'ID de l'user n'est pas null, on est en mode édition
                    $userForm->add('password', RepeatedType::class, [
                        'type' => PasswordType::class,
                        'invalid_message' => 'Les mots de passe ne sont pas identiques',
                        'options' => [
                            'attr' => [
                                'class' => 'password-field'
                            ]
                        ],
                        'required' => false,
                        'first_options' => [
                            'label' => 'Laisser vide si inchangé'
                        ],
                        'second_options' => [
                            'label' => 'Laisser vide si inchangé'
                        ],
                        'required' => false 
                    ]);
                }
            })
            ->add('isActive', CheckboxType::class, [
                'label' => 'Utilisateur actif'
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-70),
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer votre date de naissance'
                    ])
                ]
            ])
            ->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
