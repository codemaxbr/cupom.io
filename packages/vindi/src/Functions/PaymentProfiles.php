<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 18/09/2018
 * Time: 17:55
 */

namespace CodemaxBR\Vindi\Functions;


class PaymentProfiles extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("payment_profiles", ['query' => $query]);
    }

    public function exists(array $params)
    {
        $return = null;
        foreach ($params as $atributo => $valor){
            $return .= $atributo.'='.$valor.' ';
        }

        $retorno = $this->getRequest("payment_profiles/?query=".$return);
        return $retorno;
    }

    public function create(array $params)
    {
        return $this->postRequest("payment_profiles", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("payment_profiles/{$id}");
    }
    public function delete($id)
    {
        return $this->deleteRequest("payment_profiles/{$id}");
    }
    public function verify($id)
    {
        return $this->postRequest("payment_profiles/{$id}/verify");
    }
}