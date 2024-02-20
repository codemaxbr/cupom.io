<?php

namespace App\Http\Controllers\Reports;

use App\Services\StatementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /**
     * @var StatementService
     */
    private $statementService;

    /**
     * SalesController constructor.
     */
    public function __construct(StatementService $statementService)
    {
        $this->statementService = $statementService;
    }

    public function salesByPlan(Request $request)
    {
        $first_day = '2018-10-01';
        $last_day  = '2018-10-05';
        $reports = $this->statementService->getSalesByPlan($first_day, $last_day);

        dump($reports);

        return view('reports.sales_by_product')->with([
            'reports' => $reports
        ]);
    }

    public function salesByPeriod()
    {
        dump('vendas por periodo');
    }

    public function salesByPartner()
    {
        dump('vendas por parceiro');
    }
}
