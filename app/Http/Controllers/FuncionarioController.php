<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use App\Http\Requests\UserUpdatePost;
use App\Http\Requests\PostBloqueadoUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    public function admin(Request $request)
    {
        $qry = User::query()
                ->where('tipo','LIKE','A')
                ->orWhere('tipo','LIKE','F');
        //$qry =  Docente::query();


        $funcionarios = $qry->paginate(10);
        return view('funcionarios.admin')
            ->withFuncionarios($funcionarios);
    }

    public function create()
    {
        $newFuncionario = new User;
        return view('funcionarios.create')
            ->withFuncionario($newFuncionario);
    }

    public function edit(User $funcionario)
    {
        return view('funcionarios.edit')
            ->withFuncionario($funcionario);
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->tipo = $validated_data['tipo'];
        $newUser->bloqueado = 0;
        $newUser->password = Hash::make($validated_data['password']);
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos/');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        return redirect()->route('funcionarios')
            ->with('alert-msg', 'Funcionário "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function consult(User $funcionario)
    {
        return view('funcionarios.consult')
            ->withFuncionario($funcionario);
    }

    public function bloquear(PostBloqueadoUser $request, User $funcionario)
    {
            $funcionario->bloqueado = $request->validated()['bloqueado'];
            $funcionario->save();
            if ($funcionario->bloqueado==1) {
                return redirect()->route('funcionarios')
                    ->with('alert-msg', 'Cliente "' . $funcionario->name . '" foi bloqueado com sucesso!')
                    ->with('alert-type', 'success');
            }else{
                return redirect()->route('funcionarios')
                    ->with('alert-msg', 'Cliente "' . $funcionario->name . '" foi desbloqueado com sucesso!')
                    ->with('alert-type', 'success');
            }

    }

    public function delete(User $funcionario){
        try{
            $oldUserName = $funcionario->name;
            $funcionario->delete();
            return redirect()->route('funcionarios')
                ->with('alert-msg', 'Utilizador "' . $oldUserName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldUserName . '", porque este cliente já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldUserName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }

    }
    public function update(UserUpdatePost $request, User $funcionario)
    {
        dd($funcionario);
        $validated_data = $request->validated();
        $funcionario->email = $validated_data['email'];
        $funcionario->name = $validated_data['name'];
        if ($validated_data['password']!=NULL){
            $funcionario->password=Hash::make($validated_data['password']);
        }
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $funcionario->foto_url);
            $path = $request->foto->store('public/fotos/');
            $funcionario->foto_url = basename($path);
        }
        $funcionario->save();
        return redirect()->route('funcionarios')
            ->with('alert-msg', 'Funcionario "' . $funcionario->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy_foto(User $funcionario)
    {
        Storage::delete('public/fotos/' . $funcionario->foto_url);
        $funcionario->foto_url = null;
        $funcionario->save();
        return redirect()->route('funcionarios.edit', ['funcionario' => $funcionario])
            ->with('alert-msg', 'Foto do cliente "' . $funcionario->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
