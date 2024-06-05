<?php

namespace App\Models;

use \Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    public static function roleUserApi()
    {
        return Role::findByName('user', 'api');
    }

    public static function roleAdminApi()
    {
        return Role::findByName('admin', 'api');
    }
}
