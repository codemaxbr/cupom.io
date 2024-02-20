<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 11/01/2019
 * Time: 00:36
 */

namespace App\Services;


use App\Models\PriceDomain;
use App\Repositories\PriceDomainRepository;

class DomainService
{
    /**
     * @var PriceDomainRepository
     */
    private $priceDomainRepository;

    /**
     * DomainService constructor.
     */
    public function __construct(PriceDomainRepository $priceDomainRepository)
    {
        $this->priceDomainRepository = $priceDomainRepository;
    }

    public function getPriceDomains()
    {
        return $this->priceDomainRepository->findWhere(['account_id' => AccountId()]);
    }

    public function storePrice($data)
    {
        $data['account_id'] = AccountId();
        return $this->priceDomainRepository->create($data);
    }

    public function updatePrice(PriceDomain $priceDomain, $data)
    {
        foreach ($data as $index => $update)
        {
            $priceDomain->$index = $update;
        }

        return $priceDomain->save();
    }

    public function getPrice(PriceDomain $priceDomain)
    {
        return $priceDomain;
    }

    public function removePrice(PriceDomain $priceDomain)
    {
        return $priceDomain->delete();
    }
}