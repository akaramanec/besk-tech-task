<?php

namespace App\Policies;

use App\Models\Project\Currency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CurrencyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view currency rates');
    }

    public function view(User $user, Currency $currency)
    {
        return $user->hasPermissionTo('view currency rate');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create currency rate');
    }

    public function update(User $user, Currency $currency)
    {
        return $user->hasPermissionTo('update currency rate');
    }

    public function delete(User $user, Currency $currency)
    {
        return $user->hasPermissionTo('delete currency rate');
    }
}
