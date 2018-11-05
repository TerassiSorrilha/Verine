<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/05/2018
 * Time: 12:08
 */

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Filtros extends Controller
{
    private $entity;
    private $form;
    private $obj;
    private $data;
    private $dados;

    public function __construct($entity = null, $obj = null)
    {
        $this->obj = $obj;
        $this->entity = $entity;
    }

    public function geraForm(Request $request, $construct)
    {
        // procura e instancia a classe
        $this->form = $this->obj->createForm($construct);

        // controla o handle
        $this->form->handleRequest($request);

        // invoca tratamento de dados
        $this->trataDados();
    }

    // trata os campos para nao filtrar errado
    public function trataDados()
    {
        // trata os campos do form
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->data = $this->form->getData();

            // não filtra campo em branco
            foreach ($this->data as $k => $v){
                if(empty($v)){
                    unset($this->data[$k]);
                }
            }
        }
        $this->trataObjetos();
    }

    public function trataObjetos()
    {
        if(!empty($this->data)){
            //recupera tabela de usuarios
            $obj = $this->obj->getDoctrine()
                ->getRepository($this->entity)
                ->findBy($this->data);
        }
        else{
            //recupera tabela de usuarios
            $obj = $this->obj->getDoctrine()
                ->getRepository($this->entity)
                ->findAll();
        }
        if(empty($obj)) {
            // quick fix para montar a arvore de objetos
            $obj[0] = new $this->entity;
        }
        // instancia e gera relatorio
        $relatorios = new Relatorios();
        $relatorios->setObj($obj);
        $this->dados = $relatorios->getData();
    }

    public function getDados()
    {
        return $this->dados;
    }

    public function getForm()
    {
        return $this->form;
    }
}

