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
            'got' => 'TODO_get'
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
            ->findBy(["quadros" => $quadros->getId()]);

        $obj_listas = array();

        $i = 0; // futuramente sera substituido pela position
        foreach ($listas as $row){
            // faz o fetch dos cartões
            $obj_cartoes = array();
            $cartoes = $this->getDoctrine()
                ->getRepository(TODOCartoes::class)
                ->findBy(["listas" => $row->getId()]);

            $c = 0; // futuramente sera substituido pela position
            foreach($cartoes as $r){
                $obj_cartoes[$c]["id"] = $r->getId();
                $obj_cartoes[$c]["nome"] = $r->getNome();
                //$obj_cartoes[$c]["isActive"] = $r->getisActive();
                $obj_cartoes[$c]["descricao"] = $r->getDescricao();
                $c++;
            }

            $obj_listas[$i]["id"] = $row->getId();
            $obj_listas[$i]["nome"] = $row->getNome();
            $obj_listas[$i]["isActive"] = $row->getisActive();
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
}