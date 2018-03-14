<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 11:31
 */

namespace App\Controller\Forms;

use App\Entity\Post;
use App\Entity\Usuarios;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class PostForms extends AbstractType
{
    // aqui vai so o formulario de cadastro
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("id", IntegerType::class,[
                'required' => false,
                'label' => "Id",
                'attr' => [
                    'readonly' => "readonly",
                    'pai' => 'col-md-2'
                ]
            ])
            ->add("titulo", TextType::class, [
                'attr' => [
                    'pai' => 'col-md-10',
                ]
            ])
            ->add('subtitulo', TextType::class, [
                'attr' => [
                    'pai' => 'col-md-6',
                ]
            ])
            ->add('categoria', ChoiceType::class, [
                'choices' => [
                    'Ficção',
                    'Ciência',
                    'Notícias'
                ],
                'attr' => [
                    'pai' => 'col-md-3',
                ]
            ])
            ->add('autor', EntityType::class,[
                'class' => Usuarios::class,
                'choice_label' => 'name',
                'attr' => [
                    'pai' => 'col-md-3',
                ]
            ])
            ->add('texto', TextareaType::class,[
                'attr' => [
                    'pai' => 'col-md-12',
                ]
            ])
            ->add("send", SubmitType::class,[
                'label' => 'Salvar',
                'attr' => [
                    'class' => 'btn-primary pull-right',
                    'pai' => 'col-md-12 no-margin'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
        ));
    }
}