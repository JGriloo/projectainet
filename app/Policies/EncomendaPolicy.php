<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomendaPolicy
{
    use HandlesAuthorization;

    // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Aluno" entity

    public function costumers(User $user)
    {
        return ($user->tipo == 'C');
    }

    public function restore(User $user, Estampa $estampa)
    {
        //
    }

    public function forceDelete(User $user, Estampa $estampa)
    {
        //
    }
}