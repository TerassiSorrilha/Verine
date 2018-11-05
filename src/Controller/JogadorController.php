<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 05/11/2018
 * Time: 11:17
 */

namespace App\Controller;
use App\Entity\Jogador;
use App\Form\JogadoresType;
use App\Services\Filtros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/jogadores")
 */
class JogadorController extends Controller
{
    /**
     * @Route("/", name="admin_jogadores")
     */
    public function show(){
        $form = new Filtros(Jogador::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Jogadores',
            'edit' => 'admin_jogadores_single'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_jogadores_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $jogador = $this->getDoctrine()
            ->getRepository(Jogador::class)
            ->find($id);

        if(empty($jogador)){
            $jogador = new Jogador();
        }

        $form = $this->createForm(JogadoresType::class, $jogador);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $jogador = $em->merge($jogador);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_jogadores_single', ['id' => $jogador->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Jogador',
            'retorno' => 'admin_jogadores',
        ]);
    }
}