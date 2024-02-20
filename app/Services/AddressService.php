<?php
/**
 * Created by PhpStorm.
 * User: rafaellessa
 * Date: 20/09/2018
 * Time: 17:30
 */

namespace App\Services;


use App\Models\Address;
use Illuminate\Support\Facades\DB;

class AddressService
{
    private $address;

    /**
     * AddressService constructor.
     * @param $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function createAddress($dados)
    {
        return DB::table('addresses')
            ->insert($dados);
    }

    public function getAddressCustomer($id)
    {
        $address = DB::table('addresses')
            ->where('customer_id', $id)
            ->get();
        return ($address->isNotEmpty()) ? $address : NULL;
    }

    public function update($id, $dados)
    {
        return DB::table('addresses')
            ->where('customer_id', $id)
            ->update($dados);
    }

}