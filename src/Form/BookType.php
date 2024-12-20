<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => 5,
                ],
            ])
            ->add('isPublished', ChoiceType::class, [
                'choices' => [
                    'yes' => true,
                    'no'  => false,
                ],
            ])
            ->add('authors', EntityType::class, [
                'class'        => Author::class,
                'choice_label' => 'id',
                'multiple'     => true,
                'expanded'     => true,
            ])
            ->add('publisher', EntityType::class, [
                'class'        => Publisher::class,
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
