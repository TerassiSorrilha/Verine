<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;

use App\Entity\Post;
use App\Form\Type\DateTimePickerType;
use App\Form\Type\TagsInputType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the form used to create and manipulate blog posts.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // For the full reference of options defined by each form field type
        // see https://symfony.com/doc/current/reference/forms/types.html

        // By default, form fields include the 'required' attribute, which enables
        // the client-side form validation. This means that you can't test the
        // server-side validation errors from the browser. To temporarily disable
        // this validation, set the 'required' attribute to 'false':
        // $builder->add('title', null, ['required' => false, ...]);

        $builder
            ->add('title', null, [
                'attr' => [
                    'autofocus' => true,
                    'pai' => 'col-md-12',
                ],
                'label' => 'Titulo',
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Subtitulo',
                'attr' => [
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Resumo',
                'attr' => [
                    'rows' => '4',
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('insertAt', DateTimePickerType::class, [
                'label' => 'Data Cadastro',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => [
                    'readonly' => 'readonly',
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('publishedAt', DateTimePickerType::class, [
                'label' => 'Data Publicação',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => [
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('expiredAt', DateTimePickerType::class, [
                'label' => 'Data Expiração',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => [
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('content', null, [
                'label' => ' ',
                'attr' => [
                    'class' => 'gerar_WYSIWYG',
                    'rows' => 20,
                    'pai' => 'col-md-12',
                ]
            ])
            ->add('tags', TagsInputType::class, [
                'label' => 'Tags',
                'required' => false,
                'attr' => [
                    'pai' => 'col-md-12',
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
