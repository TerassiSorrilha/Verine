<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 05/11/2018
 * Time: 11:17
 */

namespace App\Controller;
use App\Entity\Liga;
use App\Form\LigaType;
use App\Services\Filtros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LigaController
 * @Route("/admin/ligas")
 */
class LigaController extends Controller
{
    /**
     * @Route("/", name="admin_ligas")
     */
    public function show(){
        $form = new Filtros(Liga::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Ligas',
            'edit' => 'admin_ligas_single'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ligas_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $liga = $this->getDoctrine()
            ->getRepository(Liga::class)
            ->find($id);

        if(empty($liga)){
            $liga = new Liga();
        }

        $form = $this->createForm(LigaType::class, $liga);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $liga = $em->merge($liga);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_ligas');
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Liga',
            'retorno' => 'admin_ligas',
        ]);
    }
}