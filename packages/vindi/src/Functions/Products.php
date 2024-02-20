<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:28
 */

namespace CodemaxBR\Vindi\Functions;


class Products extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("products", ['query' => $query]);
    }
    public function create(array $params)
    {
        return $this->postRequest("products", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("products/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("products/{$id}", ['json' => $params]);
    }

    public function exists(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        $retorno = $this->getRequest("products/?query=".$return);
        return $retorno;
    }
}