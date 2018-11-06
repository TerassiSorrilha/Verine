<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/05/2018
 * Time: 11:09
 */

namespace App\Form;
use App\Entity\Jogador;
use App\Entity\Market;
use App\Form\Type\DateTimePickerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class MarketType extends AbstractType{
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
            ->add('jogador', EntityType::class,[
                'class' => Jogador::class,
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'label-select'
                ],
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add('preco_venda', TextType::class, [
                'label' => 'Preço venda',
                'attr' => [
                    'data-mask' => '000.000.000.000.000,00',
                    'data-mask-reverse' => 'true',
                    'pai' => 'col-md-3',
                ]
            ])
            ->add('data', DateTimePickerType::class, [
                'format' => 'dd-MM-yyyy HH:mm',
                //'data' => Tools::DateUser(),
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
            'data_class' => Market::class,
        ));
    }
}