<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:27
 */

namespace CodemaxBR\Vindi\Functions;


class Invoices extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("invoices", ['query' => $query]);
    }
    public function create(array $params)
    {
        return $this->postRequest("invoices", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("invoices/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("invoices/{$id}", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("invoices/{$id}");
    }
    public function retry($id)
    {
        return $this->postRequest("invoices/{$id}/retry");
    }
}