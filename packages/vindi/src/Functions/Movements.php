<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:27
 */

namespace CodemaxBR\Vindi\Functions;


class Movements extends API
{
    public function create(array $params)
    {
        return $this->postRequest("movements", ['json' => $params]);
    }
}