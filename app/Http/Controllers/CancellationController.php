<?php

namespace App\Http\Controllers;

use App\Models\Cancellation;
use App\Services\CancellationService;
use Illuminate\Http\Request;

class CancellationController extends Controller
{
    /**
     * @var CancellationService
     */
    private $cancellationService;

    /**
     * CancellationController constructor.
     */
    public function __construct(CancellationService $cancellationService)
    {
        $this->cancellationService = $cancellationService;
    }

    public function index()
    {
        $cancellations = $this->cancellationService->getCancellations();
        return view('customers.cancellations.index')->with([
            'cancellations' => $cancellations
        ]);
    }

    public function view(Cancellation $cancellation)
    {
        dump($cancellation);
    }
}
