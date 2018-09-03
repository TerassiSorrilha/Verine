<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 01/05/2018
 * Time: 16:21
 */

namespace App\Controller;


use App\Entity\TODOCartoes;
use App\Entity\TODOListas;
use App\Entity\TODOQuadros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/admin/TODO")
 */
class TODOController extends Controller
{
    /**
     * @Route("/{id}", name="TODO_single", defaults={"id": "null"})
     */
    public function edita($id, Request $request){
        return $this->render("admin/admin_TODO.html.twig",[
            'id' => $id,
            'got' => 'TODO_get',
            'salva' => 'TODO_salva'
        ]);
    }

    /**
     * @Route("/get/{id}", name="TODO_get", defaults={"id": "null"}, methods={"GET"})
     */
    public function got($id, SerializerInterface $serializer){
        // faz o fetch
        $quadros = $this->getDoctrine()
            ->getRepository(TODOQuadros::class)
            ->find($id);

        $listas = $this->getDoctrine()
            ->getRepository(TODOListas::class)
            ->findBy(["quadros" => $quadros->getId()], ["posicao" => "ASC"]);

        $obj_listas = array();

        $i = 0; // futuramente sera substituido pela position
        foreach ($listas as $row){
            // faz o fetch dos cartões
            $obj_cartoes = array();
            $cartoes = $this->getDoctrine()
                ->getRepository(TODOCartoes::class)
                ->findBy(["listas" => $row->getId()], ["posicao" => "ASC"]);

            $c = 0; // futuramente sera substituido pela position
            foreach($cartoes as $r){
                $obj_cartoes[$c]["id"] = $r->getId();
                $obj_cartoes[$c]["nome"] = $r->getNome();
                $obj_cartoes[$c]["active"] = $r->getisActive();
                $obj_cartoes[$c]["descricao"] = $r->getDescricao();
                $c++;
            }

            $obj_listas[$i]["id"] = $row->getId();
            $obj_listas[$i]["nome"] = $row->getNome();
            $obj_listas[$i]["active"] = $row->getisActive();
            $obj_listas[$i]["cartoes"] = $obj_cartoes;

            $i++;
        }

        // retorna apenas o mais importante
        $obj_quadros = [
            "id" => $quadros->getId(),
            "nome" => $quadros->getNome(),
            "usuario" => $quadros->getUsuario()->getName(),
            "cod_usuario" => $quadros->getUsuario()->getId(),
            "listas" => $obj_listas,
        ];

        // converte
        $jsonContent = $serializer->serialize($obj_quadros, 'json');

        return new Response($jsonContent);
    }

    /**
     * @Route("/set/{id}", name="TODO_salva", defaults={"id": "null"}, methods={"POST"})
     */
    public function salva($id, Request $request){
        $dados = $request->request->all();

        // faz o fetch do quadro
        $quadro = $this->getDoctrine()
            ->getRepository(TODOQuadros::class)
            ->find($id);

        // senão existe ele cria um novo
        if(empty($quadro)){
            $quadro = new TODOQuadros();
        }

        // primeiro ajusta os dados do quadro
        $quadro->setNome($dados["nome"]);
        $quadro->setUsuario($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $quadro = $em->merge($quadro);    // sempre manter o objeto atalizado

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        // itera as listas
        foreach ($dados["listas"] as $l){
            $lista = $this->getDoctrine()
                ->getRepository(TODOListas::class)
                ->find($l["id"]);

            if(empty($lista)){
                $lista = new TODOListas();
            }

            $lista->setNome($l["nome"]);
            $lista->setQuadros($quadro);
            $lista->setIsActive($l["active"]);
            $lista->setPosicao($l["posicao"]);

            $em = $this->getDoctrine()->getManager();       // sempre manter o objeto atalizado
            $lista = $em->merge($lista);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            // itera as cards
            if(!empty($l["cards"])) {
                foreach ($l["cards"] as $c) {
                    $card = $this->getDoctrine()
                        ->getRepository(TODOCartoes::class)
                        ->find($c["id"]);

                    if (empty($card)) {
                        $card = new TODOCartoes();
                    }

                    $card->setNome($c["nome"]);
                    $card->setListas($lista);
                    $card->setIsActive($c["active"]);
                    $card->setPosicao($c["posicao"]);
                    $card->setDescricao($c["descricao"]);

                    $em = $this->getDoctrine()->getManager();
                    $em->merge($card);    // atualiza o objeto original

                    // actually executes the queries (i.e. the INSERT query)
                    $em->flush();
                }
            }
        }
        return new Response("sucesso");

    }
}