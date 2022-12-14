<?php

/**
 * Comment type.
 */

namespace App\Form\Type;

use App\Entity\Comment;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommentType.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array<string, mixed> $options Form options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'nick',
            TextType::class,
            [
                'label' => '%nick%',
                'label_translation_parameters' => [
                    '%nick%' => 'nick',
                ],
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'email',
            EmailType::class,
            [
                'label' => '%email%',
                'label_translation_parameters' => [
                    '%email%' => 'email',
                ],
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'book',
            EntityType::class,
            [
                'class' => Book::class,
                'choice_label' => function ($book): string {
                    return $book->getTitle();
                },
                'label' => '%book%',
                'label_translation_parameters' => [
                    '%book%' => 'Ksiazka',
                ],
                'required' => true,
            ]
        );
        $builder->add(
            'context',
            TextType::class,
            [
                'label' => '%context%',
                'label_translation_parameters' => [
                    '%context%' => 'Tresc',
                ],
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Comment::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'comment';
    }
}
