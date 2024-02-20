<?php

namespace App\Http\Controllers;

use App\Models\AbandonedCart;
use App\Services\AbandonedCartService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbandonedCartRequest;

class AbandonedCartsController extends Controller
{
    private $abandoned_cartService;

    /**
     * AbandonedCartsController constructor.
     */
    public function __construct(AbandonedCartService $abandoned_cartService)
    {
        $this->abandoned_cartService = $abandoned_cartService;
    }

    /**
     * Página => Lista Cadastros
     * @method GET
     */
	public function index()
	{
		$abandoned_carts = $this->abandoned_cartService->getAbandonedCarts(20);
		return view('abandoned_carts.index', compact('abandoned_carts'));
	}

    /**
     * Página => Ver detalhes (AbandonedCart)
     * Exibe todos os dados do cadastro e seus relacionamentos.
     * @method GET
     */
    public function show($id)
    {
        $this->abandoned_cartService->setId($id);
        $abandoned_cart = $this->abandoned_cartService->getAbandonedCart();
        return view('abandoned_carts.show', compact('abandoned_cart'));
    }

    /**
     * Página => Formulário de Cadastro
     * @method GET
     */
	public function create()
	{
		return view('abandoned_carts.add');
	}

	/**
     * Página => Formulário para Editar Cadastro
     * @method GET
     */
    public function edit($id)
    {
        $this->abandoned_cartService->setId($id);
        $abandoned_cart = $this->abandoned_cartService->getAbandonedCart();
        return view('abandoned_carts.edit', compact('abandoned_cart'));
    }

    /**
     * Submit => Remover um(a) AbandonedCart
     * @method DELETE
     */
    public function destroy($id)
    {
        $this->abandoned_cartService->setId($id);
        $this->abandoned_cartService->deleteAbandonedCart();

        return redirect()->route('abandoned_carts.index')->with('success', 'AbandonedCart removido(a) com sucesso.');
    }

    /**
     * Submit => Remover uma lista de AbandonedCarts
     * @method POST
     */
    public function destroyJSON(Request $request)
    {
        $input = (object) $request->all();
        $itens = (object) $input->selecionados;

        foreach ($itens as $item){
            $this->abandoned_cartService->deleteAbandonedCart($item['id']);
        }

        $request->session()->flash('status', 'Todos os cadastros selecionados foram removidos.');
        return response()->json(true);
    }

    /**
     * Submit => Criar um(a) novo(a) AbandonedCart
     * @method POST
     */
	public function store(AbandonedCartRequest $request)
	{
		$abandoned_cart = AbandonedCart::create($request->all());
		return redirect()->route('abandoned_carts.show', $abandoned_cart->id)->with('success', 'AbandonedCart adicionado com sucesso.');
	}

    /**
     * Submit => Atualiza dados de um(a) AbandonedCart
     * @method POST
     */
	public function update(AbandonedCartRequest $request, $id)
	{
        $this->abandoned_cartService->setId($id);
        $this->abandoned_cartService->updateAbandonedCart($request->all());
		return redirect()->route('abandoned_carts.show', $id)->with('success', 'Dados de abandoned_cart atualizado(s).');
	}

    /**
     * Submit => Buscar um(a) abandoned_cart (Busca Simples)
     * @method GET
     */
    public function search(Request $request)
    {
        if($request->busca != null){
            $abandoned_carts = $this->abandoned_cartService->searchAbandonedCarts('nome', $request->busca, 20);
        }else{
            $abandoned_carts = $this->abandoned_cartService->getAbandonedCarts(20);
        }

        return view('abandoned_carts.index')->with([
            'abandoned_carts' => $abandoned_carts->appends(request()->query())
        ]);
    }

    /**
     * Submit => Buscar um(a) abandoned_cart (Busca Avançada)
     * @method GET
     */
    public function searchAdvanced(Request $request)
    {
        if(isset($request->filtro)){
            $filtro = $request->filtro;
        }else{
            $filtro = null;
        }

        $abandoned_carts = $this->abandoned_cartService->searchAbandonedCarts_filter($filtro);

        return view('abandoned_carts.index')->with([
            'abandoned_carts' => $abandoned_carts->appends(request()->query())
        ]);
    }
}