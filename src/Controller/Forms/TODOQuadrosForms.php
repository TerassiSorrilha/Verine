<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 27/04/2018
 * Time: 13:50
 */

namespace App\Controller\Forms;


use App\Entity\TODOQuadros;
use App\Entity\Usuarios;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TODOQuadrosForms extends AbstractType
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
            ->add('nome', TextType::class, [
                'attr' => [
                    'pai' => 'col-md-4'
                ]
            ])
            ->add('usuario', EntityType::class,[
                'class' => Usuarios::class,
                'choice_label' => 'name',
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Salvar',
                'attr' => [
                    'class' => 'btn-primary pull-right',
                    'pai' => 'col-md-12'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TODOQuadros::class
        ));
    }
}


