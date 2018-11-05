<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/05/2018
 * Time: 11:09
 */

namespace App\Form;
use App\Entity\Clube;
use App\Entity\Jogador;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class JogadoresType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        // aqui vai so o formulario de cadastro
        $builder
            ->add("id", IntegerType::class,[
                'required' => false,
                'label' => "Id",
                'attr' => [
                    'readonly' => "readonly",
                    'pai' => 'col-md-2'
                ]
            ])
            ->add("name", TextType::class, [
                'label' => "Nome",
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add('posicao', TextType::class, [
                'attr' => [
                    'pai' => 'col-md-3',
                ]
            ])
            ->add('clube', EntityType::class,[
                'class' => Clube::class,
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'label-select'
                ],
                'attr' => [
                    'pai' => 'col-md-3',
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
            'data_class' => Jogador::class,
        ));
    }
}