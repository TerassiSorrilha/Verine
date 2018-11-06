<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 15/02/2018
 * Time: 10:57
 */

namespace App\Services;


class Relatorios
{
    private $obj;
    private $data = array();
    private $header;

    private function getRelatorio($retorno = null){
        $arr = array();
        foreach ($this->obj as $obj){
            $arr[] = $obj->relatorio();
        }
        return $arr;
    }

    /**
     * @param mixed $obj
     */
    public function setObj($obj): void
    {
        $this->obj = $obj;
    }

    /**
     * @return mixed
     */
    public function getData($rel = false)
    {
        if(!empty($rel)){
            $relatorio = $rel;
        }
        else {
            $relatorio = $this->getRelatorio();
        }

        $this->header = $this->getHeader($relatorio[0]);
        $this->data["itens"] = (empty($relatorio[0]["Id"]) ? false : $relatorio);
        $this->data["header"] = $this->header;
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getHeader($relatorio)
    {
        $arr = array();
        foreach($relatorio as $k => $v){
            $arr[] = $k;
        }
        return $arr;
    }

}