<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:28
 */

namespace CodemaxBR\Vindi\Functions;


class ProductItems extends API
{
    public function get($id)
    {
        return $this->getRequest("product_items/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("product_items/{$id}", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("product_items/{$id}");
    }
    public function create(array $params)
    {
        return $this->postRequest("product_items", ['json' => $params]);
    }
}