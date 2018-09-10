<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/05/2018
 * Time: 11:03
 */

namespace App\Form\Search;


use App\Entity\Niveis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuariosSearch extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        // aqui vai so o formulario de cadastro
        $builder
            ->setMethod("GET")
            ->add("id", IntegerType::class,[
                'required' => false,
                'label' => "Id",
                'attr' => ['pai' => 'col-md-3']
            ])
            ->add("name", TextType::class, [
                'required' => false,
                'label' => "Nome",
                'attr' => [
                    'pai' => 'col-md-6',
                ]
            ])
            ->add("nivel", EntityType::class, [
                'label' => "Nível",
                'class' => Niveis::class,
                'required' => false,
                'label_attr' => [
                    'class' => 'label-select'
                ],
                'choice_label' => 'name',
                'attr' => [
                    'pai' => 'col-md-3'
                ]
            ])
            ->add("username", TextType::class, [
                'required' => false,
                'label' => "Login",
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add("email", EmailType::class, [
                'required' => false,
                'label' => "E-mail",
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add("send", SubmitType::class,[
                'label' => 'pesquisar',
                'attr' => [
                    'class' => 'pull-right btn-primary',
                    'pai' => 'col-md-4 no-margin'
                ]
            ]);
    }
}