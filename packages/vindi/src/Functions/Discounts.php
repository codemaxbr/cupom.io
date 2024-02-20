<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:27
 */

namespace CodemaxBR\Vindi\Functions;


class Discounts extends API
{
    public function create($params)
    {
        return $this->postRequest("discounts", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("discounts/{$id}");
    }
    public function delete($id)
    {
        return $this->deleteRequest("discounts/{$id}");
    }
}