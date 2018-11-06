<?php

namespace App\Repository;

use App\Entity\Market;
use App\Utils\Tools;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MarketRepository extends ServiceEntityRepository
{
    private $result;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Market::class);
    }

    /**
     * @return Market[]
     */
    public function customFind($params = array()){
        $query = $this  ->createQueryBuilder('m')
                        ->addSelect('j')
                        ->addSelect('c')
                        ->addSelect('l')
                        ->leftJoin('m.jogador', 'j')
                        ->leftJoin('j.clube', 'c')
                        ->leftJoin('c.liga', 'l');
        if(!empty($params)){
            $query->setParameters($params);
        }
        $query = $query->getQuery()->getResult();

        $this->result = $query;
        return $query;
    }

    // esta função deve ser chamada junto com o customfind
    public function relatorio(){
        $array = array();

        // itera os resultados
        foreach ($this->result as $row){
            $array[] = [
                "Id" => $row->getId(),
                "Jogador" => $row->getJogador()->getName(),
                "Preço Venda" => $row->getPrecoVenda(),
                "Preço Compra" => $row->getPrecoCompra(),
                "Clube" => $row->getJogador()->getClube()->getName(),
                "Liga" => $row->getJogador()->getClube()->getLiga()->getName(),
                "Data" => Tools::DateUser($row->getData())
            ];
        }

        if(empty($this->result)){
            $array[] = [
                "Id" => "",
                "Jogador" => "",
                "Preço Venda" => "",
                "Preço Compra" => "",
                "Clube" => "",
                "Liga" => "",
                "Data"
            ];
        }

        return $array;
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
