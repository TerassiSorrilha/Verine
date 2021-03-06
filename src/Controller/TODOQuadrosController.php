<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 27/04/2018
 * Time: 13:37
 */

namespace App\Controller;


use App\Controller\Forms\TODOQuadrosForms;
use App\Entity\TODOQuadros;
use App\Services\Relatorios;
use App\Services\Undo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TODOQuadrosController extends Controller
{
    /**
     * @Route("/admin/quadros/", name="admin_todo_quadros")
     */
    public function show(){
        $obj = $this->getDoctrine()
            ->getRepository(TODOQuadros::class)
            ->findAll();

        if(empty($obj)){
            // quick fix para montar a arvore de objetos
            $obj[0] = new TODOQuadros();

            // instancia e gera relatorio
            $relatorios = new Relatorios();
            $relatorios->setObj($obj);
            $relatorio = $relatorios->getData();

            // zera itens para consetar na view
            $relatorio["itens"] = false;
        }
        else{
            $relatorios = new Relatorios();
            $relatorios->setObj($obj);
            $relatorio = $relatorios->getData();
        }

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $relatorio,
            'title' => 'Quadros',
            'edit' => 'TODO_single',
        ]);
    }

    /**
     * @Route("admin/quadros/{id}", name="admin_todo_quadros_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        dump($_SESSION);
        // 1) build the form
        $em = $this->getDoctrine()->getManager();

        $quadro = $em->getRepository(TODOQuadros::class)->find($id);

        if(empty($quadro)){
            $quadro = new TODOQuadros();
        }

        // clone para manter as propriedades intactas
        $old = clone $quadro;

        $form = $this->createForm(TODOQuadrosForms::class, $quadro);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $undo = new Undo($this, $em);
            $quadro = $undo->merge($quadro, $old);

            return $this->redirectToRoute('admin_todo_quadros_single', ['id' => $quadro->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Nível',
            'retorno' => 'admin_todo_quadros',
        ]);
    }
}