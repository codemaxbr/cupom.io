<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:29
 */

namespace CodemaxBR\Vindi\Functions;


class Subscriptions extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("subscriptions", ['query' => $query]);
    }

    public function exists(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        $retorno = $this->getRequest("subscriptions/?query=".$return);
        return $retorno;
    }

    public function create(array $params)
    {
        return $this->postRequest("subscriptions", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("subscriptions/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("subscriptions/{$id}", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("subscriptions/{$id}");
    }
    public function renew($id)
    {
        return $this->postRequest("subscriptions/{$id}/renew");
    }
    public function reactivate($id)
    {
        return $this->postRequest("subscriptions/{$id}/reactivate");
    }
}