<?php

namespace App\Form;

use App\Entity\CharacterProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CharacterProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar')
            ->add('age')
            ->add('race')
            ->add('class', TextType::class, [
                'label' => 'Classe'
            ])
            ->add('socialCast', TextType::class, [
                'label' => 'Caste sociale'
            ])
            ->add('localisation')
            ->add('miscellaneous', TextareaType::class, [
                'label' => 'Faits divers'
            ])
            ->add('link1', TextType::class, [
                'label' => 'Fiche de présentation'
            ])
            ->add('link2', TextType::class, [
                'label' => 'Relations'
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
