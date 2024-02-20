<?php

namespace App\Http\Controllers;

use App\Events\ConfirmPayment;
use App\Models\Invoice;
use App\Services\AccountService;
use App\Services\ConfigService;
use App\Services\CustomerService;
use App\Services\InvoiceService;
use App\Services\StatementService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Webpatser\Uuid\Uuid;

class InvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;
    /**
     * @var CustomerService
     */
    private $customerService;
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var ConfigService
     */
    private $configService;
    /**
     * @var StatementService
     */
    private $statementService;

    /**
     * InvoiceController constructor.
     */
    public function __construct(InvoiceService $invoiceService, CustomerService $customerService, AccountService $accountService, ConfigService $configService, StatementService $statementService)
    {
        $this->invoiceService = $invoiceService;
        $this->customerService = $customerService;
        $this->accountService = $accountService;
        $this->configService = $configService;
        $this->statementService = $statementService;
    }

    public function index()
    {
        $invoices = $this->invoiceService->getInvoices(20);
        $total_pending = $this->invoiceService->totalPending(date('Y'), date('m'));
        $total_paid = $this->invoiceService->totalPaid(date('Y'), date('m'));
        $total_overdue = $this->invoiceService->totalOverdue(date('Y'), date('m'));
        $total_income = $this->invoiceService->totalIncome(date('Y'), date('m'));

        return view('invoices.index')->with([
            'invoices' => $invoices,
            'total_pending' => $total_pending,
            'total_paid' => $total_paid,
            'total_overdue' => $total_overdue,
            'total_income' => $total_income
        ]);
    }

    public function view($id)
    {
        $this->invoiceService->setUuid($id);
        $invoice = $this->invoiceService->getInvoice();
        $subtotal = $invoice->invoice_items->sum(function ($item){
            return $item->qty * $item->price - $item->discount;
        });

        $type_payments = $this->configService->getTypePayments();

        return view('invoices.view')->with([
            'invoice' => $invoice,
            'subtotal' => $subtotal,
            'type_payments' => $type_payments
        ]);
    }

    public function addInvoice()
    {
        $types = $this->configService->getTypesPlan();
        $types_invoice = $this->configService->getTypesInvoice();

        return view('invoices.add')->with([
            'types' => $types,
            'tipos_fatura' => $types_invoice
        ]);
    }

    public function addItem()
    {
        return view('invoices.add_item', compact('types'));
    }

    public function changeDue(Request $request, Invoice $invoice)
    {
        $this->invoiceService->setId($invoice->id);
        $this->invoiceService->changeDue(Carbon::parse(dateEUA($request->due)));

        return redirect()->route('invoice.view', $invoice->uuid)->with('success', 'A data de vencimento da fatura nº '.$invoice->id.' foi alterada para ('.$request->due.').');
    }

    public function changePaid(Request $request, Invoice $invoice)
    {
        event(new ConfirmPayment($invoice, $request));
        $this->invoiceService->setId($invoice->id);
        $this->invoiceService->setStatus(1, null);

        return redirect()->route('invoice.view', $invoice->uuid)->with('success', 'Pagamento confirmado da fatura nº '.$invoice->id.'.');
    }

    public function changeCancelled(Request $request, Invoice $invoice)
    {
        $this->invoiceService->setId($invoice->id);
        $this->invoiceService->setStatus(3, $request->motivo_cancelamento);

        return redirect()->route('invoice.view', $invoice->uuid)->with('success', 'O status da fatura nº '.$invoice->id.' foi alterada.');
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $this->invoiceService->setId($invoice->id);
        $this->invoiceService->remove();

        return redirect()->route('invoices.index')->with('success', 'A fatura Nº '.$invoice->id.', foi removida.');
    }

    public function create(Request $request)
    {
        if(!empty($request->vencimento) && !empty($request->emissao))
        {
            $date = explode('/', $request->vencimento);
            $request->vencimento = $date[2].'-'.$date[1].'-'.$date[0];

            $date2 = explode('/', $request->emissao);
            $request->emissao = $date2[2].'-'.$date2[1].'-'.$date2[0];
        }

        $inv = array(
            'customer_id'       => $request->customer,
            'type_invoice_id'   => $request->type_invoice,
            'due'               => $request->vencimento,
            'created_at'        => $request->emissao,
            'fee'               => ($request->taxas != '') ? numFormat_US($request->taxas) : 0,
            'discount'          => ($request->desconto != '') ? numFormat_US($request->desconto) : 0,
            'account_id'        => $request->account_id,
            'total'             => $request->total,
            'reason'            => $request->motivo,
            'obs'               => $request->obs,
            'uuid'              => Uuid::generate()->string,
            'status'            => 0,
            'invoice_items'     => array()
        );

        foreach ($request->items as $item)
        {
            $item = (object) $item;

            $add_item = array(
                'type_plan_id'  => $item->tipo,
                'plan_id'       => $item->produto_servico,
                'domain'        => $item->dominio,
                'description'   => $item->descricao,
                'price'         => $item->valor,
                'discount'      => $item->desconto,
                'qty'           => $item->qtd
            );

            array_push($inv['invoice_items'], $add_item);
        }

        $invoice = $this->invoiceService->newInvoice($inv);
        return redirect()->route('invoices.index')->with('success', 'Uma nova fatura foi gerada: Nº '.$invoice->id.' para "'.$invoice->customer->name.'"');
    }

    public function resumo()
    {
        //faz o tratamento da data
        $data_atual = Carbon::now();
        $data_formatada = explode('-', $data_atual);
        $ano = $data_formatada[0];
        $mes = $data_formatada[1];

        $total = $this->statementService->totalGeral('2018-10-01', $data_atual);

        $statements = $this->statementService->getStatetementsMes($mes, $ano);
        //dd($statements, $total);
        return view('invoices.financial_summary')->with([
            'statements'    =>  $statements
        ]);
    }

    public function searchSimples(Request $request)
    {

        //$invoices = $this->invoiceService->getInvoices(20);
        $total_pending = $this->invoiceService->totalPending(date('Y'), date('m'));
        $total_paid = $this->invoiceService->totalPaid(date('Y'), date('m'));
        $total_overdue = $this->invoiceService->totalOverdue(date('Y'), date('m'));
        $total_income = $this->invoiceService->totalIncome(date('Y'), date('m'));

        //pega a data no input e formata
        $input = (object) $request->all();

        $process = explode(' - ', $input->due);

        $firstday = dateFormat(str_replace('/', '-',$process[0]), "Y-m-d");
        $lastday = dateFormat(str_replace('/', '-',$process[1]), "Y-m-d");

        $invoices = $this->invoiceService->searchSimples($firstday, $lastday);

        return view('invoices.index')->with([
            'invoices'  =>  $invoices,
            'total_pending' => $total_pending,
            'total_paid' => $total_paid,
            'total_overdue' => $total_overdue,
            'total_income' => $total_income
        ]);

    }

    public function searchAdvanced(Request $request)
    {
        $total_pending = $this->invoiceService->totalPending(date('Y'), date('m'));
        $total_paid = $this->invoiceService->totalPaid(date('Y'), date('m'));
        $total_overdue = $this->invoiceService->totalOverdue(date('Y'), date('m'));
        $total_income = $this->invoiceService->totalIncome(date('Y'), date('m'));

        $input = (object) $request->all();

        if($input->vencimento != null)
        {
            $input->vencimento = dateFormat(str_replace('/', '-', $input->vencimento), 'Y-m-d');
        }

        $busca = [
            'status'    =>  $input->situation,
            'customer'  =>  $input->cliente,
            'due'       =>  $input->vencimento
        ];

        $invoices = $this->invoiceService->searchAdvanced($busca);

        return view('invoices.index')->with([
            'invoices'  =>  $invoices,
            'total_pending' => $total_pending,
            'total_paid' => $total_paid,
            'total_overdue' => $total_overdue,
            'total_income' => $total_income
        ]);



    }
}
