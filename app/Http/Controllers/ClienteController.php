<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Http\Requests\ClientePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
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

    public function bloquear(ClientePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->user->bloqueado = $validated_data['bloqueado'];
        $cliente->user->bloqueado = 1;
        $cliente->user->save();
        return redirect()->route('clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi bloqueado com sucesso!')
            ->with('alert-type', 'success');
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
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $cliente->user->foto_url);
            $path = $request->foto->store('public/fotos/');
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->save();
        return redirect()->route('clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cliente $cliente)
    {
        $oldName = $cliente->user->name;
        $oldUserID = $cliente->id;
        $oldUrlFoto = $cliente->user->foto_url;
        try {
            $cliente->delete();
            User::destroy($oldUserID);
            Storage::delete('public/fotos/' . $oldUrlFoto);
            return redirect()->route('clientes')
                ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '", porque este cliente já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
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
}