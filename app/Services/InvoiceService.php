<?php
/**
 * Created by PhpStorm.
 * User: Codemax Sistemas
 * Date: 11/12/2017
 * Time: 19:56
 */

namespace App\Services;


use App\Models\Invoice;
use App\Repositories\InvoiceItemsRepository;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class InvoiceService
{
    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;
    /**
     * @var InvoiceItemsRepository
     */
    private $invoiceItemsRepository;
    private $account_id;
    private $invoice_id;
    private $invoice_uuid;
    private $invoicesCustomer;

    /**
     * InvoiceService constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param InvoiceItemsRepository $invoiceItemsRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository, InvoiceItemsRepository $invoiceItemsRepository)
    {

        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceItemsRepository = $invoiceItemsRepository;
    }

    /**
     * Mostra todas os registros
     * @param null $paginate
     * @return mixed
     */
    public function getInvoices($paginate = null)
    {
        $result = Invoice::with(['customer:id,name,email,uuid'])->where(['account_id' => AccountId()]);

        if(!is_null($paginate)){
            return $result->paginate($paginate);
        }else{
            return $result->all();
        }
    }

    public function setId($id)
    {
        $this->invoice_id = $id;
    }

    public function setUuid($uuid)
    {
        $this->invoice_uuid = $uuid;
    }

    /**
     * Mostra detalhes de uma fatura
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoiceRepository->with([
                'customer',
                'type_invoice',
                'invoice_items',
                'invoice_items.plan',
                'statement',
                'statement.type_payment',
                'statement.user',
                'statement.attachments',
                'invoice_items.type_plan',
                'attachment'
            ])
            ->findWhere(['uuid' => $this->invoice_uuid])->first();
    }

    public function getInvoicesCustomer($id)
    {
        return Invoice::all()->where('customer_id' , $id);
    }



    /**
     * Exite total "Pendente"
     * @param $year
     * @param $monthy
     * @return float|mixed
     */
    public function totalPending($year, $monthy)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_pending'))
            ->where('status', 0)
            ->whereYear('due', '=', $year)->whereMonth('due', '=', $monthy)
            ->first();

        return ($count->total_pending != null) ? $count->total_pending : 0.00;
    }

    public function totalInvoiceCustomer($id)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_pending'))
            ->where('status', 0)
            ->where('customer_id', $id)
            ->first();

        return ($count->total_pending != null) ? $count->total_pending : 0.00;
    }

    public function totalPendingCustomer($dataAtual, $id)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_pending'))
            ->where('status', 0)
            ->where('customer_id', $id)
            ->where('due', '<=', $dataAtual)
            ->first();

        return ($count->total_pending != null) ? $count->total_pending : 0.00;
    }


    /**
     * Exibe total "Pago"
     * @param $year
     * @param $monthy
     * @return float|mixed
     */
    public function totalPaid($year, $monthy)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_paid'))
            ->where('status', 1)
            ->whereYear('due', '=', $year)->whereMonth('due', '=', $monthy)
            ->first();

        return ($count->total_paid != null) ? $count->total_paid : 0.00;
    }

    /**
     * Exibe total "Não pago / Em atraso"
     * @param $year
     * @param $monthy
     * @return float|mixed
     */
    public function totalOverdue($year, $monthy)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_overdue'))
            ->where('status', 2)
            ->whereYear('due', '=', $year)->whereMonth('due', '=', $monthy)
            ->first();

        return ($count->total_overdue != null) ? $count->total_overdue : 0.00;
    }

    /**
     * Exibe total "A receber do mês"
     * @param $year
     * @param $monthy
     * @return float|mixed
     */
    public function totalIncome($year, $monthy)
    {
        $count = DB::table('invoices')->select(DB::raw('sum(total) as total_income'))
            ->whereYear('due', '=', $year)->whereMonth('due', '=', $monthy)
            ->first();

        return ($count->total_income != null) ? $count->total_income : 0.00;
    }

    public function changeDue($date_due)
    {
        return $this->invoiceRepository->update(['due' => $date_due], $this->invoice_id);
    }

    /**
     * Altera o status da fatura
     * @param Integer $status_code
     * @param null $obs
     * @return mixed
     */
    public function setStatus($status_code, $obs)
    {
        return $this->invoiceRepository->update(['status' => (int) $status_code, 'obs' => $obs], $this->invoice_id);
    }

    /**
     * Excluir uma fatura
     * @return int
     */
    public function remove()
    {
        return $this->invoiceRepository->delete($this->invoice_id);
    }

    ####################################################################################################################

    public function getAll_items($invoice_id)
    {
        $invoices = DB::table('invoice_items as ivt')
            ->where('ivt.invoice_id', $invoice_id)
            ->orderBy('id', 'asc')
            ->get();

        return ($invoices->isNotEmpty()) ? $invoices : $invoices;
    }

    public function addItems($items)
    {
        if(!empty($items)){
            return DB::table('invoice_items')->insertGetId($items);
        }
    }

    public function newInvoice($dados)
    {
        $items = $dados['invoice_items'];
        $invoice = Invoice::create($dados);

        foreach ($items as $item){
            $invoice->invoice_items()->create($item);
        }

        return $invoice;
    }

    public function searchSimples($firstday, $lastday)
    {
        return Invoice::query()->whereBetween('due', [$firstday, $lastday])->where(['account_id'    =>  AccountId()])->paginate(20);
    }

    public function searchAdvanced($busca)
    {
        $invoices = Invoice::query();
        if($busca['status']  != null)
        {
            $invoices->where('status', $busca['status']);
        }

        if($busca['customer'] != null)
        {
            $invoices->with(['customer'])->whereHas('customer', function ($query) use ($busca){
                $query->where('name', 'LIKE', "%{$busca['customer']}%");
            });
        }

        if($busca['due'] !=null)
        {
            $invoices->where('due', $busca['due']);
        }

        $invoices->where(['account_id'  =>  AccountId()])->orderBy('id', 'desc');

        return($invoices->paginate(20)->total() != 0) ? $invoices->paginate(20) : NULL;
    }
}