<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Http\Requests\ClientePost;
use App\Http\Requests\PostBloqueadoUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']); //só consegue entrar em todos os metodos do perfil se tiver o e-mail verificado
    }

    public function admin(Request $request)
    {
        $qry = Cliente::query();
        //$qry =  Docente::query();

        $clientes = $qry->paginate(10);
        return view('clientes.admin')
            ->withClientes($clientes);
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit')
            ->withCliente($cliente);
    }

    public function consult(Cliente $cliente)
    {
        return view('clientes.consult')
            ->withCliente($cliente);
    }

    public function bloquear(PostBloqueadoUser $request, Cliente $cliente)
    {
            $cliente->user->bloqueado = $request->validated()['bloqueado'];
            $cliente->user->save();
            if ($cliente->user->bloqueado==1) {
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi bloqueado com sucesso!')
                    ->with('alert-type', 'success');
            }else{
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi desbloqueado com sucesso!')
                    ->with('alert-type', 'success');
            }

    }

    public function create()
    {
        $newCliente = new Cliente;
        $newCliente->user = new User;
        return view('clientes.create')
            ->withCliente($newCliente);
    }

    public function store(ClientePost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->nif = $validated_data['nif'];
        $newUser->enderco = $validated_data['enderco'];
        $newUser->tipo = 'C';
        $newUser->password = Hash::make('123');
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos/');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        $cliente = new Cliente;
        $cliente->id = $newUser->id;
        $cliente->save();
        return redirect()->route('clientes')
            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(ClientePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->user->email = $validated_data['email'];
        $cliente->user->name = $validated_data['name'];
        $cliente->nif = $validated_data['nif'];
        $cliente->endereco = $validated_data['endereco'];
        if ($request->hasFile('foto_url')) {
            Storage::delete('public/fotos/' . $cliente->user->foto_url);
            $path = $request->foto->store('public/fotos/');
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->save();
        return redirect()->route('dashboard')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy_foto(Cliente $cliente)
    {
        Storage::delete('public/fotos/' . $cliente->user->foto_url);
        $cliente->user->foto_url = null;
        $cliente->user->save();
        return redirect()->route('clientes.edit', ['cliente' => $cliente])
            ->with('alert-msg', 'Foto do cliente "' . $cliente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function delete(Cliente $cliente){
        try{
            $oldUserID = $cliente->id;
            $oldUserName = $cliente->user->name;
            $cliente->delete();
            User::where('id','=',$oldUserID)->delete();
            return redirect()->route('clientes')
                ->with('alert-msg', 'Cliente "' . $oldUserName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldUserName . '", porque este cliente já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldUserName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }

    }
}