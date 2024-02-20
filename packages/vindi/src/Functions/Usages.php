<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:29
 */

namespace CodemaxBR\Vindi\Functions;


class Usages extends API
{
    public function create(array $params)
    {
        return $this->postRequest("usages", ['json' => $params]);
    }
    public function delete($id)
    {
        return $this->deleteRequest("usages/{$id}");
    }
}