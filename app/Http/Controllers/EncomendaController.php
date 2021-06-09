<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Encomenda;
use App\Models\Tshirt;
use App\Models\User;
use App\Http\Requests\EncomendaPost;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Cart;

class EncomendaController extends Controller
{
    public function admin(Request $request)
    {
        $encomendasQuery = Encomenda::where('cliente_id', '=', Auth::user()->id);
        //$qry =  Docente::query();
        //$thirts = Tshirt::where('encomenda_id', '=', $encomendasQuery)->first();

        $encomendas = $encomendasQuery->paginate(10);
        return view('encomendas.index')
            ->withEncomendas($encomendas);
    }

    public function detalhesEncomenda(){
        $qry = Encomenda::where('cliente_id', '=', Auth::user()->id);
    }

        /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'estado' => ['required'],
            'cliente_id' => ['required'],
            'data' => ['required'],
            'notas' => ['nullable', 'string', 'max:255'],
            'preco_total' => ['required'],
            'nif' => ['required','string','digits:9'],
            'endereco' => ['required','string','max:255'],
            'tipo_pagamento' => ['required'],
            'ref_pagamento' => ['required','string'],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function checkout(EncomendaPost $request)
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $encomenda = new Encomenda;

        $encomenda = Encomenda::create([
            var_dump($request),
            'estado' => 'pendente',
            'cliente_id' => Auth::user()->id,
            'data' => now(),
            'notas' => $request['notas'],
            'preco_total' => $cart->totalPreco,
            'nif' => $request['nif'],
            'endereco' => $request['endereco'],
            'tipo_pagamento' => $request['tipo_pagamento'],
            'ref_pagamento' => $request['ref_pagamento'],
        ]);

        $encomenda->save();
        return view('estampas')
            ->with('alert-msg', 'Encomenda foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
}