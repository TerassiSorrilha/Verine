<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 05/11/2018
 * Time: 11:14
 */

namespace App\Form;


use App\Entity\Liga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigaType extends AbstractType
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
            'data_class' => Liga::class
        ));
    }
}