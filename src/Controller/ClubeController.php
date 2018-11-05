<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 05/11/2018
 * Time: 11:17
 */

namespace App\Controller;
use App\Entity\Clube;
use App\Form\ClubeType;
use App\Services\Filtros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/clubes")
 */
class ClubeController extends Controller
{
    /**
     * @Route("/", name="admin_clubes")
     */
    public function show(){
        $form = new Filtros(Clube::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Clubes',
            'edit' => 'admin_clubes_single'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_clubes_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $clube = $this->getDoctrine()
            ->getRepository(Clube::class)
            ->find($id);

        if(empty($clube)){
            $clube = new Clube();
        }

        $form = $this->createForm(ClubeType::class, $clube);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $clube = $em->merge($clube);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_clubes_single', ['id' => $clube->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Clubes',
            'retorno' => 'admin_clubes',
        ]);
    }
}