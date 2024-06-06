<?php

namespace App\Policies;

use App\Models\Project\Currency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\http\Response as HttpResponse;

class CurrencyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return self::getResponse($user->hasPermissionTo('view currency rates'));
    }

    public function view(User $user)
    {
        return self::getResponse($user->hasPermissionTo('view currency rate'));
    }

    public function create(User $user)
    {
        return self::getResponse($user->hasPermissionTo('create currency rate'));
    }

    public function update(User $user)
    {
        return self::getResponse($user->hasPermissionTo('update currency rate'));
    }

    public function delete(User $user)
    {
        return self::getResponse($user->hasPermissionTo('delete currency rate'));
    }

    public static function getResponse($permission)
    {
        return $permission
            ? Response::allow()
            : Response::deny('You don\'t have permission to do this.', HttpResponse::HTTP_FORBIDDEN);
    }
}
