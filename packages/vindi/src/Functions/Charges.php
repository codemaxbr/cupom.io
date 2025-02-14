<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:27
 */

namespace CodemaxBR\Vindi\Functions;


class Charges extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("charges", ['query' => $query]);
    }
    public function get($id)
    {
        return $this->getRequest("charges/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("charges/{$id}", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("charges/{$id}");
    }
    public function reissue($id, array $params)
    {
        return $this->postRequest("charges/{$id}/reissue", ['json' => $params]);
    }
    public function charge($id, array $params)
    {
        return $this->postRequest("charges/{$id}/charge", ['json' => $params]);
    }
    public function refund($id, array $params)
    {
        return $this->postRequest("charges/{$id}/refund", ['json' => $params]);
    }
    public function fraud_review($id, array $params)
    {
        return $this->postRequest("charges/{$id}/fraud_review", ['json' => $params]);
    }
}