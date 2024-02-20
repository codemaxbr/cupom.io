<?php

namespace App\Http\Controllers;

use App\Models\PriceDomain;
use App\Services\DomainService;
use Illuminate\Http\Request;

class PriceDomainController extends Controller
{
    /**
     * @var DomainService
     */
    private $domainService;

    /**
     * PriceDomainController constructor.
     */
    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function index()
    {
        $priceDomains = $this->domainService->getPriceDomains();
    }

    public function update(Request $request, PriceDomain $priceDomain)
    {

    }

    public function viewEdit(PriceDomain $priceDomain)
    {

    }

    public function viewCreate()
    {

    }

    public function store(Request $request)
    {

    }

    public function delete(PriceDomain $priceDomain)
    {

    }
}
