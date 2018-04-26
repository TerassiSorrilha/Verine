<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 08:08
 */

namespace App\Controller;

use App\Controller\Forms\UsuariosForms;
use App\Entity\Niveis;
use App\Entity\Usuarios;
use App\Services\Relatorios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsuariosController extends Controller
{
    //private $form;
    private $filter;

    public function filter(Request $request){
        $this->form = $this   ->createFormBuilder()
            ->add("sc_id", IntegerType::class,[
                'required' => false,
                'label' => "Id",
                'attr' => ['pai' => 'col-md-3']
            ])
            ->add("sc_name", TextType::class, [
                'required' => false,
                'label' => "Nome",
                'attr' => [
                    'pai' => 'col-md-6',
                ]
            ])
            ->add("sc_nivel", EntityType::class, [
                'label' => "Nível",
                'class' => Niveis::class,
                'required' => false,
                'choice_label' => 'name',
                'attr' => [
                    'pai' => 'col-md-3'
                ]
            ])
            ->add("sc_login", TextType::class, [
                'required' => false,
                'label' => "Login",
                'attr' => [
                    'pai' => 'col-md-4',
                ]
            ])
            ->add("sc_email", EmailType::class, [
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
            ])
            ->getForm();

        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $data = $this->form->getData();

            // array que vai guardar os filtros
            $this->filter = array();

            if(isset($data["sc_id"])){
                $this->filter["id"] = $data["sc_id"];
            }
            if(isset($data["sc_name"])){
                $this->filter["name"] = $data["sc_name"];
            }
            if(isset($data["sc_nivel"])){
                $this->filter["nivel"] = $data["sc_nivel"];
            }
            if(isset($data["sc_login"])){
                $this->filter["login"] = $data["sc_login"];
            }
            if(isset($data["sc_email"])){
                $this->filter["email"] = $data["sc_email"];
            }
        }
    }

    /**
     * @Route("/admin/usuarios/", name="admin_usuarios")
     */
    public function show(Request $request)
    {
        self::filter($request);

        if(!empty($this->filter)){
            //recupera tabela de usuarios
            $obj = $this->getDoctrine()
                        ->getRepository(Usuarios::class)
                        ->findBy($this->filter);
        }
        else{
            //recupera tabela de usuarios
            $obj = $this->getDoctrine()
                        ->getRepository(Usuarios::class)
                        ->findAll();
        }

        if(empty($obj)) {
            // quick fix para montar a arvore de objetos
            $obj[0] = new Usuarios();

            // instancia e gera relatorio
            $relatorios = new Relatorios();
            $relatorios->setObj($obj);
            $relatorio = $relatorios->getData();

            // zera itens para consetar na view
            $relatorio["itens"] = false;
        }
        else{
            // instancia e gera relatorio
            $relatorios = new Relatorios();
            $relatorios->setObj($obj);
            $relatorio = $relatorios->getData();
        }

        // passa dados recuperados para a view
        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $relatorio,
            'form'  => $this->form->createView(),
            'title' => 'Usuarios',
            'edit' => 'admin_usuarios_single',
        ]);
    }

    /**
     * @Route("/admin/usuario/{id}", name="admin_usuarios_single", defaults={"id": "null"})
     */
    public function edita(UserPasswordEncoderInterface $encoder, Request $request, $id){
        // 1) build the form
        $usuario = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->find($id);

        if(empty($usuario)){
            $usuario = new Usuarios();
        }

        $form = $this->createForm( UsuariosForms::class, $usuario);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // faz o encode da senha
            $encoded = $encoder->encodePassword($usuario, $form["password"]->getData());
            $usuario->setPassword($encoded);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $usuario = $em->merge($usuario);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_usuarios_single', ['id' => $usuario->getId()]);
        }

        return $this->render( 'admin/admin_edit_padrao.html.twig', [
               'form' => $form->createView(),
                'title' => 'Usuario',
                'retorno' => 'admin_usuarios'
            ]
        );
    }
}