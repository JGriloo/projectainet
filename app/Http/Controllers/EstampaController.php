<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Cart;
use App\Http\Requests\EstampaPost;
use App\Http\Requests\EncomendaPost;
use App\Models\Cores;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Facades\Auth;

class EstampaController extends Controller
{
    public function admin(Request $request)
    {
        $categoria = $request->categoria ?? '';

        $qry = Estampa::with('categoriaRef');
        //$qry =  Aluno::query();

        if ($categoria) {
            $qry->where('categoria_id', $categoria);
        }

        $estampas = $qry->paginate(10);
        $categorias = Categoria::pluck('nome', 'id');
        return view('estampas.index')
            ->withEstampas($estampas)
            ->withCategorias($categorias)
            ->withSelectedCategoria($categoria);
    }

    public function edit(Estampa $estampa)
    {
        return view('estampas.edit')
            ->withEstampa($estampa);
    }

    public function consult(Estampa $estampa)
    {
        return view('estampas.consult')
            ->withEstampa($estampa);
    }

    public function update(EstampaPost $request, Estampa $estampa)
    {
        $validated_data = $request->validated();
        $estampa->nome = $validated_data['nome'];
        $estampa->descricao = $validated_data['descricao'];
        $estampa->imagem_url = $validated_data['imagem_url'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/estampas/' . $estampa->imagem_url);
            $path = $request->foto->store('public/estampas/');
            $estampa->imagem_url = basename($path);
        }
        $estampa->save();
        return redirect()->route('estampas')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function store(EstampaPost $request)
    {
        $validated_data = $request->validated();
        $newEstampa = new Estampa;
        $newEstampa->nome = $validated_data['nome'];
        $newEstampa->descricao = $validated_data['descricao'];
        $newEstampa->informacao_extra = $validated_data['informacao_extra'];
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos/');
            $newEstampa->imagem_url = basename($path);
        }
        $newEstampa->save();
        return redirect()->route('estampas')
            ->with('alert-msg', 'Estampa "' . $validated_data['nome'] . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function delete(Estampa $estampa){
        try{
            $oldEstampaID = $estampa->id;
            $oldEstampaNome = $estampa->nome;
            $estampa->delete();
            User::where('id','=',$oldEstampaID)->delete();
            return redirect()->route('estampas')
                ->with('alert-msg', 'Estampa "' . $oldEstampaNome . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('estampas')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldEstampaNome . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas')
                    ->with('alert-msg', 'Não foi possível apagar o Estampa "' . $oldEstampaNome . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function addToCart(Request $request, $id){
        $estampa = Estampa::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($estampa, $estampa->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('estampas');
    }

    public function shoppingCart(Request $request, Cliente $cliente){
        if(!Session::has('cart')){
            return view('estampas.shoppingCart', ['estampas' => null]);
        }
        $cor = $request->cor ?? '';

        $cliente = Cliente::where('id', '=', Auth::user()->id)->first();

        $qry = Cores::with('tshirtRef');
        //$qry =  Aluno::query();

        if ($cor) {
            $qry->where('cor_id', $cor);
        }
        $cores = Cores::where('deleted_at', NULL )->pluck('nome', 'codigo');
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('estampas.shoppingCart', ['estampas' => $cart->estampas, 'totalPreco' => $cart->totalPreco])
            ->withCores($cores)
            ->withSelectedCor($cor)
            ->withCliente($cliente);
    }
}
