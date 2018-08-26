<?php

namespace App\Form;

use App\Entity\CharacterProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CharacterProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characterName', TextType::class, [
                'required' => false,
                'label' => 'Nom de votre personnage',
                'constraints' => New Length([
                    'max' => 24,
                    'maxMessage' => 'Le nom de votre personnage est trop long, il doit faire 24 caractères maximum'
                ])
            ])
            ->add('age', TextType::class, [
                'label' => 'Age',
                'required'   => false,

            ])
            ->add('race', TextType::class, [
                'label' => 'Race',
                'required'   => false,

            ])
            ->add('class', TextType::class, [
                'label' => 'Classe',
                'required'   => false,

            ])
            ->add('socialCast', TextType::class, [
                'label' => 'Classe sociale',
                'required'   => false,
            ])
            ->add('localisation', TextType::class, [
                'label' => 'Localisation',
                'required'   => false,
            ])
            ->add('miscellaneous', TextareaType::class, [
                'label' => 'Faits divers',
                'required'   => false,
            ])
            ->add('link1', TextType::class, [
                'label' => 'Fiche de présentation',
                'required'   => false,
                'attr' => array(
                    'placeholder' => 'Insérez le lien vers votre fiche de présentation'
                    )
                    
            ])
            ->add('link2', TextType::class, [
                'label' => 'Relations',
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Insérez le lien vers votre fiche de relations'
                    ]
            ])
            ->add('avatar', TextType::class, [
                'label' => 'Avatar',
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Insérez le lien direct vers votre image'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterProfile::class,
        ]);
    }
}
