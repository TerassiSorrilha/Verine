<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PessoaRepository")
 * @ORM\Entity
 * @ORM\Table(name="pessoa")
 */
class Pessoa implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $tipo;
    /**
     * @ORM\Column(type="string")
     */
    private $nome;
    /**
     * @ORM\Column(type="string")
     */
    private $nome_fantasia;
    /**
     * @ORM\Column(type="string")
     */
    private $cpf_cnpj;
    /**
     * @ORM\Column(type="string")
     */
    private $rg;
    /**
     * @ORM\Column(type="string")
     */
    private $cnae;
    /**
     * @ORM\Column(type="string")
     */
    private $imagem;
    /**
     * @ORM\Column(type="text")
     */
    private $observacoes;
    /**
     * @ORM\Column(type="integer")
     */
    private $segmento;              //foreign
    /**
     * @ORM\Column(type="integer")
     */
    private $vendedor;              //foreign
    /**
     * @ORM\Column(type="integer")
     */
    private $conta_pagamento;       //foreign
    /**
     * @ORM\Column(type="integer")
     */
    private $lista_preco;           //foreign
    /**
     * @ORM\Column(type="integer")
     */
    private $area;                  //foreign
    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;
    /**
     * @ORM\Column(type="boolean")
     */
    private $cliente;
    /**
     * @ORM\Column(type="boolean")
     */
    private $fornecedor;
    /**
     * @ORM\Column(type="boolean")
     */
    private $funcionario;
    /**
     * @ORM\Column(type="boolean")
     */
    private $empresa;
    /**
     * @ORM\Column(type="boolean")
     */
    private $transportador;
    /**
     * @ORM\Column(type="boolean")
     */
    private $agrupa_boleto;
    /**
     * @ORM\Column(type="boolean")
     */
    private $contribuinte_icms;
    /**
     * @ORM\Column(type="integer")
     */
    private $forma_pagamento;
    /**
     * @ORM\Column(type="integer")
     */
    private $condicao_pagamento;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNomeFantasia()
    {
        return $this->nome_fantasia;
    }

    /**
     * @param mixed $nome_fantasia
     */
    public function setNomeFantasia($nome_fantasia): void
    {
        $this->nome_fantasia = $nome_fantasia;
    }

    /**
     * @return mixed
     */
    public function getCpfCnpj()
    {
        return $this->cpf_cnpj;
    }

    /**
     * @param mixed $cpf_cnpj
     */
    public function setCpfCnpj($cpf_cnpj): void
    {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg): void
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * @param mixed $cnae
     */
    public function setCnae($cnae): void
    {
        $this->cnae = $cnae;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem): void
    {
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * @param mixed $observacoes
     */
    public function setObservacoes($observacoes): void
    {
        $this->observacoes = $observacoes;
    }

    /**
     * @return mixed
     */
    public function getSegmento()
    {
        return $this->segmento;
    }

    /**
     * @param mixed $segmento
     */
    public function setSegmento($segmento): void
    {
        $this->segmento = $segmento;
    }

    /**
     * @return mixed
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    /**
     * @param mixed $vendedor
     */
    public function setVendedor($vendedor): void
    {
        $this->vendedor = $vendedor;
    }

    /**
     * @return mixed
     */
    public function getContaPagamento()
    {
        return $this->conta_pagamento;
    }

    /**
     * @param mixed $conta_pagamento
     */
    public function setContaPagamento($conta_pagamento): void
    {
        $this->conta_pagamento = $conta_pagamento;
    }

    /**
     * @return mixed
     */
    public function getListaPreco()
    {
        return $this->lista_preco;
    }

    /**
     * @param mixed $lista_preco
     */
    public function setListaPreco($lista_preco): void
    {
        $this->lista_preco = $lista_preco;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area): void
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo): void
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * @param mixed $fornecedor
     */
    public function setFornecedor($fornecedor): void
    {
        $this->fornecedor = $fornecedor;
    }

    /**
     * @return mixed
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setFuncionario($funcionario): void
    {
        $this->funcionario = $funcionario;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa): void
    {
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getTransportador()
    {
        return $this->transportador;
    }

    /**
     * @param mixed $transportador
     */
    public function setTransportador($transportador): void
    {
        $this->transportador = $transportador;
    }

    /**
     * @return mixed
     */
    public function getAgrupaBoleto()
    {
        return $this->agrupa_boleto;
    }

    /**
     * @param mixed $agrupa_boleto
     */
    public function setAgrupaBoleto($agrupa_boleto): void
    {
        $this->agrupa_boleto = $agrupa_boleto;
    }

    /**
     * @return mixed
     */
    public function getContribuinteIcms()
    {
        return $this->contribuinte_icms;
    }

    /**
     * @param mixed $contribuinte_icms
     */
    public function setContribuinteIcms($contribuinte_icms): void
    {
        $this->contribuinte_icms = $contribuinte_icms;
    }

    /**
     * @return mixed
     */
    public function getFormaPagamento()
    {
        return $this->forma_pagamento;
    }

    /**
     * @param mixed $forma_pagamento
     */
    public function setFormaPagamento($forma_pagamento): void
    {
        $this->forma_pagamento = $forma_pagamento;
    }

    /**
     * @return mixed
     */
    public function getCondicaoPagamento()
    {
        return $this->condicao_pagamento;
    }

    /**
     * @param mixed $condicao_pagamento
     */
    public function setCondicaoPagamento($condicao_pagamento): void
    {
        $this->condicao_pagamento = $condicao_pagamento;
    }


}
