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
use Symfony\Component\Validator\Constraints\NotBlank;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('description', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'attr'     => [
                    'rows' => 5,
                ],
            ])
            ->add('isPublished', ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'yes' => true,
                    'no'  => false,
                ],
            ])
            ->add('authors', EntityType::class, [
                'required'     => false,
                'class'        => Author::class,
                'choice_label' => 'fullName',
                'multiple'     => true,
                'expanded'     => true,
            ])
            ->add('publisher', EntityType::class, [
                'required'     => false,
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
