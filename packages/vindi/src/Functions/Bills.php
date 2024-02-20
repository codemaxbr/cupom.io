<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:26
 */

namespace CodemaxBR\Vindi\Functions;


class Bills extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("bills", ['query' => $query]);
    }
    public function create(array $params)
    {
        return $this->postRequest("bills", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("bills/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("bills/{$id}", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("bills/{$id}");
    }
    public function approve($id)
    {
        return $this->postRequest("bills/{$id}/approve");
    }
    public function charge($id, array $params)
    {
        return $this->postRequest("bills/{$id}/charge", ['json' => $params]);
    }
    public function invoice($id, array $params)
    {
        return $this->postRequest("bills/{$id}/invoice", ['json' => $params]);
    }
}