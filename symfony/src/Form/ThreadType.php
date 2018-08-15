<?php

namespace App\Form;

use App\Entity\Thread;
use App\Form\PostType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ThreadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ;
        $builder
            ->add('posts', CollectionType::class, array(
                'entry_type' => PostType::class,
                'entry_options' => array('label' => false))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Thread::class,
        ]);
    }
}
