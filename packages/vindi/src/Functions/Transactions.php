<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:29
 */

namespace CodemaxBR\Vindi\Functions;


class Transactions extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("transactions", ['query' => $query]);
    }
    public function create($id, array $params)
    {
        return $this->postRequest("transactions/{$id}/charge", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("transactions/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("transactions/{$id}", ['json' => $params]);
    }
}