<?php
/**
 * Created by PhpStorm.
 * User: rafaellessa
 * Date: 20/09/2018
 * Time: 14:33
 */

namespace App\Services;


use App\Models\Statement;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\DB;

class StatementService
{
    private $statementRepository;


    /**
     * StatementService constructor.
     * @param $statementRepository
     */
    public function __construct(Statement $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function getSalesByPlan($first_day, $last_day)
    {
        return Statement::with('invoice', 'totalPedido')
            ->whereBetween('created_at', [$first_day, $last_day])
            ->where(['account_id' => AccountId()])
            ->groupBy('plan_id')
            ->get();
    }

    public function getStatementsCustomer($id)
    {
        $statemtents = DB::table('statements as s')
            ->where('s.customer_id', $id)
            ->get();

        return ($statemtents->isNotEmpty()) ? $statemtents : NULL;
    }


    public function getStatetementCustomerMes($id, $month, $year)
    {
        $statemtents = DB::table('statements as s')
            ->where('s.customer_id', $id)
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at','=', $month)
            ->get();

        return ($statemtents->isNotEmpty()) ? $statemtents : NULL;
    }

    public function totalGeral($first_day, $last_day)
    {
        $count = Statement::query()
            ->select(
                DB::raw('sum(total) as total'),
                DB::raw('count(id) as qty')
            )
            ->whereBetween('created_at', [$first_day, $last_day])
            ->whereIn('type_invoice_id', [3, 2])
            ->first();

        return $count;
    }

    public function getStatetementsMes($month, $year)
    {
        return Statement::query()
            ->whereYear('created_at','=', $year)
            ->whereMonth('created_at', '=', $month)
            ->paginate(20);
    }







}