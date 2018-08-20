<?php

namespace App\Form;

use App\Entity\Thread;
use App\Form\PostType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ThreadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    New NotBlank([
                        'message' => 'Veuillez entrer un titre'
                    ])
                ]
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre'
            ])
            ->add('content', TextareaType::class, array('attr' => array('class' => 'ckeditor'))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // $resolver->setDefaults([
        //     'data_class' => Thread::class,
        // ]);
    }
}
