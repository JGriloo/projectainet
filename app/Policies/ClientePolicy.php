<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Aluno" entity

    public function viewAny(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function view(User $user, Cliente $cliente)
    {
        return ($user->id == $cliente->id);
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Cliente $cliente)
    {
        return $user->id == $cliente->id;
    }

    public function bloquear(User $user, Cliente $cliente)
    {
        return ($user->tipo == 'A');
    }

    public function delete(User $user, Cliente $cliente)
    {
        return ($user->tipo == 'A');
    }

    public function restore(User $user, Cliente $cliente)
    {
        //
    }

    public function forceDelete(User $user, Cliente $cliente)
    {
        //
    }
}