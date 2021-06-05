<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function view(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function bloquear(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function delete(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function create(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function update(User $user)
    {
        return ($user->tipo == 'A');
    }

    public function __construct()
    {
        //
    }
}
