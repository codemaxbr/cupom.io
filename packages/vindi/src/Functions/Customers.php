<?php

namespace CodemaxBR\Vindi\Functions;

use CodemaxBR\Vindi\Functions\API;

class Customers extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("customers", ['query' => $query]);
    }

    public function create(array $params)
    {
        return $this->postRequest("customers", ['json' => $params]);
    }

    public function get($id)
    {
        return $this->getRequest("customers/{$id}");
    }

    public function delete($id)
    {
        return $this->deleteRequest("customers/{$id}");
    }

    public function exists(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        $retorno = $this->getRequest("customers/?query=".$return);
        return $retorno;
    }

    public function search(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        return $this->getRequest("customers/?query=".$return);
    }

    public function update($id, array $params)
    {
        return $this->putRequest("customers/{$id}", ['json' => $params]);
    }

    public function unarchive($id)
    {
        return $this->postRequest("customers/{$id}/unarchive");
    }
}