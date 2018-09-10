<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/05/2018
 * Time: 15:10
 */

namespace App\Form;


use App\Entity\Niveis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', IntegerType::class, [
                'required' => false,
                'label' => 'Id',
                'attr' => [
                    'readonly' => 'readonly',
                    'pai' => 'col-md-4'
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'pai' => 'col-md-4'
                ]
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Salvar',
                'attr' => [
                    'class' => 'btn-primary pull-right',
                    'pai' => 'col-md-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Niveis::class
        ));
    }

}