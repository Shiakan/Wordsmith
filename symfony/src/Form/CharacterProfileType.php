<?php

namespace App\Form;

use App\Entity\CharacterProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar')
            ->add('age')
            ->add('race')
            ->add('class')
            ->add('socialCast')
            ->add('localisation')
            ->add('miscellaneous')
            ->add('link1')
            ->add('link2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterProfile::class,
        ]);
    }
}
