<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 19/09/2018
 * Time: 15:26
 */

namespace CodemaxBR\Vindi\Functions;


class BillItems extends API
{
    public function get($id)
    {
        return $this->getRequest("bill_items/{$id}");
    }
}