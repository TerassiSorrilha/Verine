<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 27/04/2018
 * Time: 14:48
 */

namespace App\Controller;


use App\Controller\Forms\TODOCartoesForms;
use App\Entity\TODOCartoes;
use App\Services\Relatorios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TODOCartoesController extends Controller
{
    /**
     * @Route("/admin/cartoes/", name="admin_todo_cartoes")
     */
    public function show(){
        $obj = $this->getDoctrine()
            ->getRepository(TODOCartoes::class)
            ->findAll();

        if(empty($obj)){
            // quick fix para montar a arvore de objetos
            $obj[0] = new TODOCartoes();

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
            'title' => 'Listas',
            'edit' => 'admin_todo_cartoes_single',
        ]);
    }

    /**
     * @Route("admin/cartoes/{id}", name="admin_todo_cartoes_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $listas = $this->getDoctrine()
            ->getRepository(TODOCartoes::class)
            ->find($id);

        if(empty($listas)){
            $listas = new TODOCartoes();
        }

        $form = $this->createForm(TODOCartoesForms::class, $listas);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $quadro = $em->merge($listas);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_todo_cartoes_single', ['id' => $listas->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Nível',
            'retorno' => 'admin_todo_cartoes',
        ]);
    }
}