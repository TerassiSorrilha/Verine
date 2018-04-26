<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 08:08
 */

namespace App\Controller;


use App\Controller\Forms\NiveisForms;
use App\Entity\Niveis;
use App\Services\Relatorios;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class NiveisController extends Controller
{
    /**
     * @Route("/admin/niveis/", name="admin_niveis")
     */
    public function show(){
        $obj = $this->getDoctrine()
                    ->getRepository(Niveis::class)
                    ->findAll();

        if(empty($obj)){
            // quick fix para montar a arvore de objetos
            $obj[0] = new Niveis();

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
            'title' => 'Níveis',
            'edit' => 'admin_niveis_single',
        ]);
    }

    /**
     * @Route("admin/niveis/{id}", name="admin_niveis_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $nivel = $this->getDoctrine()
                    ->getRepository(Niveis::class)
                    ->find($id);

        if(empty($nivel)){
            $nivel = new Niveis();
        }

        $form = $this->createForm(NiveisForms::class, $nivel);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $usuario = $em->merge($nivel);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_niveis_single', ['id' => $usuario->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Nível',
            'retorno' => 'admin_niveis',
        ]);
    }
}