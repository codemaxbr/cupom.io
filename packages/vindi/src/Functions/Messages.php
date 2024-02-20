<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:27
 */

namespace CodemaxBR\Vindi\Functions;


class Messages extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("messages", ['query' => $query]);
    }
    public function create(array $params)
    {
        return $this->postRequest("messages", ['json' => $params]);
    }
    public function get($id)
    {
        return $this->getRequest("messages/{$id}");
    }
}