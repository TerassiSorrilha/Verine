<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 05/11/2018
 * Time: 11:17
 */

namespace App\Controller;
use App\Entity\Market;
use App\Form\MarketType;
use App\Services\Filtros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/market")
 */
class MarketController extends Controller
{
    /**
     * @Route("/", name="admin_market")
     */
    public function show(){
        $form = new Filtros(Market::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Market',
            'edit' => 'admin_market_single'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_market_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $market = $this->getDoctrine()
            ->getRepository(Market::class)
            ->find($id);

        if(empty($market)){
            $market = new Market();
        }

        $form = $this->createForm(MarketType::class, $market);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $market = $em->merge($market);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_market_single', ['id' => $market->getId()]);
        }

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Market',
            'retorno' => 'admin_market',
        ]);
    }
}