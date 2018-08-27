<?php

namespace App\Form;

use App\Entity\CharacterProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CharacterNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characterName', TextType::class, [
                'required' => true,
                'label' => 'Nom de votre personnage',
                'constraints' => New Length([
                    'max' => 24,
                    'maxMessage' => 'Le nom de votre personnage est trop long, il doit faire 24 caractères maximum'
                ]),
                'attr' => array(
                    'placeholder' => 'Vous devez renseigner le nom de votre personnage pour entrer dans une room'
                )
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
