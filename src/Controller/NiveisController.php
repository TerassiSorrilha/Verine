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
use http\Env\Request;
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
    public function edit($id){
        // 1) build the form
        $nivel = $this->getDoctrine()
                    ->getRepository(Niveis::class)
                    ->find($id);

        if(empty($nivel)){
            $nivel = new Niveis();
        }

        $form = $this->createForm(NiveisForms::class, $nivel);

        return $this->render('admin/admin_edit_padrao.html.twig',[
            'form' => $form->createView(),
            'title' => 'Nível',
            'retorno' => 'admin_niveis',
        ]);
    }
}