<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 08:08
 */

namespace App\Controller;


use App\Entity\Niveis;
use App\Form\NiveisType;
use App\Services\Filtros;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/niveis")
 */
class NiveisController extends Controller
{
    /**
     * @Route("/", name="admin_niveis")
     */
    public function show(){
        $form = new Filtros(Niveis::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Níveis',
            'edit' => 'admin_niveis_single',
        ]);
    }

    /**
     * @Route("/{id}", name="admin_niveis_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $nivel = $this->getDoctrine()
                    ->getRepository(Niveis::class)
                    ->find($id);

        if(empty($nivel)){
            $nivel = new Niveis();
        }

        $form = $this->createForm(NiveisType::class, $nivel);

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