<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:28
 */

namespace CodemaxBR\Vindi\Functions;


class Periods extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("periods", ['query' => $query]);
    }
    public function get($id)
    {
        return $this->getRequest("periods/{$id}");
    }
    public function update($id, array $params)
    {
        return $this->putRequest("periods/{$id}", ['json' => $params]);
    }
    public function bill($id)
    {
        return $this->postRequest("periods/{$id}/bill");
    }
}