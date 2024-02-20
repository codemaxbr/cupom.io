<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:25
 */

namespace CodemaxBR\Vindi\Functions;


class Plans extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("plans", ['query' => $query]);
    }
    public function create(array $params)
    {
        return $this->postRequest("plans", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("plans/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("plans/{$id}", ['json' => $params]);
    }

    public function exists(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        $retorno = $this->getRequest("plans/?query=".$return);
        return $retorno;
    }
}