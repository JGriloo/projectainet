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
            'ref_pagamento' => ['required','string','digits:16'],
        ]);
    }

    public function checkout(EncomendaPost $request)
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $validated_data = $request->validated();
        $newEncomenda = new Encomenda;
        $newEncomenda->estado = 'pendente';
        $newEncomenda->cliente_id = Auth::user()->id;
        $newEncomenda->data = now();
        $newEncomenda->notas = $validated_data['notas'];
        $newEncomenda->preco_total = $cart->totalPreco;
        $newEncomenda->nif = $validated_data['nif'];
        $newEncomenda->endereco = $validated_data['endereco'];
        $newEncomenda->tipo_pagamento = $validated_data['tipo_pagamento'];
        $newEncomenda->ref_pagamento = $validated_data['ref_pagamento'];
        $newEncomenda->save();
        return redirect()->route('estampas')
            ->with('alert-msg', 'Encomenda foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
}