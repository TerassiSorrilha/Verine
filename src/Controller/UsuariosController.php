<?php

namespace App\Controller;

use App\Entity\Niveis;
use App\Entity\Usuarios;
use App\Services\Relatorios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsuariosController extends Controller
{
    /**
     * @Route("/admin/usuarios/", name="app_usuarioshow")
     */
    public function show(Request $request)
    {
        $defaultData = array("message" => "coloque a mensagem");
        $form = $this   ->createFormBuilder($defaultData)
                        ->add("nome", TextType::class, [
                            'required' => false,
                            'attr' => [
                                'class' => 'testesteste',
                                'readonly' => 'readonly',
                                'pai' => 'col-md-4',
                            ]
                        ])
                        ->add("id", IntegerType::class,[
                            'required' => false,
                            'attr' => ['pai' => 'col-md-4']
                        ])
                        ->add("send", SubmitType::class)
                        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
        }

        //recupera tabela de usuarios
        $obj = $this->getDoctrine()
                    ->getRepository(Usuarios::class)
                    ->findAll();

        // instancia e gera relatorio
        $relatorios = new Relatorios();
        $relatorios->setObj($obj);
        $relatorio = $relatorios->getData();

        // passa dados recuperados para a view
        return $this->render('admin/admin_usuarios.html.twig', [
            'usuarios' => $relatorio,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/usuarios/{id}", name="app_usuarioshow_single", defaults={"id": "null"},)
     */
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
     */
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
}
