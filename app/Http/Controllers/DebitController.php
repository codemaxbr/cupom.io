<?php

namespace App\Http\Controllers;

use App\Services\DebitService;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    /**
     * @var DebitService
     */
    private $debitService;

    /**
     * DebitController constructor.
     */
    public function __construct(DebitService $debitService)
    {
        $this->debitService = $debitService;
    }

    public function index()
    {
        $debits = $this->debitService->getAll();
        return view('debits.index')->with([
            'debits' => $debits
        ]);
    }
}
