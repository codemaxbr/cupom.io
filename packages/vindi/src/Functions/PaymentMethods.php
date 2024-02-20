<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:28
 */

namespace CodemaxBR\Vindi\Functions;


class PaymentMethods extends API
{
    public function all(array $query = [])
    {
        return $this->getRequest("payment_methods", ['query' => $query]);
    }
    public function get($id)
    {
        return $this->getRequest("payment_methods/{$id}");
    }
}