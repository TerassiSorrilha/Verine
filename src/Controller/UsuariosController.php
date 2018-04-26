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
    public function edita(Request $request, $id){
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

    /**
     * @Route("/admin/usuarios/{id}", name="app_usuarioshow_single", defaults={"id": "null"},)

    public function showSingle($id){

        // puxa os dados filtrando pela id
        $usuario = $this->getDoctrine()
                        ->getRepository(Usuarios::class)
                        ->find($id);

        //puxa niveis para prencher o select
        //recupera tabela de usuarios
        $niveis = $this->getDoctrine()
            ->getRepository(Niveis::class)
            ->findAll();

        // inicia o array para nao dar erro
        $nivel = array();
        if(!empty($niveis)) {
            foreach ($niveis as $n) {
                $nivel[$n->getId()] = $n->getName();
            }
        }


        $campos = array(
            [
                'name'      => 'Id',
                'class'     => 'col-md-4',
                'default'   => (!empty($usuario)) ? $usuario->getId(): '',
                'opt'       => 'readonly'
            ],
            [
                'name'      => 'Nome',
                'class'     => 'col-md-4',
                'default'   => (!empty($usuario)) ? $usuario->getName(): ''
            ],
            [
                'name'  => 'Login',
                'class' => 'col-md-4',
                'default'   => (!empty($usuario)) ? $usuario->getLogin(): ''
            ],
            [
                'name'  => 'E-mail',
                'class' => 'col-md-4',
                'type'  => 'email',
                'default'   => (!empty($usuario)) ? $usuario->getEmail(): ''
            ],
            [
                'name'      => 'Nível',               //nome do imput e texto da label
                'class'     => 'col-md-4',             //classes da div
                'type'      => 'select',               //tipo do input, se array sera select
                'values'    => $nivel,
                //'opt'   => 'disabled',          //opcionais do input, uma string que sera printada
                //'alias' => 'Primeiro nome'      //alias que apararecera na label sobrescrevendo o name
                'default'   => (!empty($usuario)) ? $usuario->getNivel()->getId(): ''
            ],
            [
                'name'  => 'Password',
                'class' => 'col-md-4',
                'default'   => (!empty($usuario)) ? $usuario->getPassword(): ''
            ]
        );

        return $this->render('admin/admin_usuarios_single.html.twig', [
            'campos' => $campos,
            'id' => (!empty($usuario)) ? $usuario->getId(): ''
        ]);
    }

    /**
     * @Route("form/admin/usuarios/", name="salva_usuario", methods={"POST"})

    public function Salva()
    {
        $em = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();

        $usuario = new Usuarios();
        $usuario->setName($request->request->get("nome"));
        $usuario->setEmail($request->request->get("e-mail"));
        $usuario->setLogin($request->request->get("login"));
        $usuario->setNivel($em->find("App:Niveis",$request->request->getInt("nivel")));
        $usuario->setPassword($request->request->get("password"));

        // se for novo nao tera id e ele precisa ser gerada pelo doctrine
        if($request->request->get("id")){
            $usuario->setId($request->request->get("id"));
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $usuario = $em->merge($usuario);    // atualiza o objeto original

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return$this->redirectToRoute('app_usuarioshow_single', ['id' => $usuario->getId()]);
        //return $this->render('admin/admin_usuarios_single.html.twig');
    }
    */
}