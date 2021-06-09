<?php

namespace App\Policies;

use App\Models\Estampa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstampaPolicy
{
    use HandlesAuthorization;

    // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Aluno" entity

    public function doAny(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function viewAny(User $user)
    {
        return ($user->tipo == 'A' || $user->tipo == 'C');
    }

    public function costumers(User $user)
    {
        return ($user->tipo == 'C' || Auth::guest() == true);
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