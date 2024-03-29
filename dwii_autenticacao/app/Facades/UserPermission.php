<?php

namespace App\Facades;

use App\Models\Permission;

class UserPermission
{

    public static function loadPermissions($user_type)
    {

        $sess = array();
        $perm = Permission::where('type_id', $user_type)->get();

        foreach ($perm as $item) {

            $sess[$item->regra] = (bool) $item->permissao;
        }

        session(['user_permissions' => $sess]);
    }

    public static function isAuthorized($rule)
    {



        $permissions = session('user_permissions');


        return $permissions[$rule];
    }

    public static function test()
    {
        return "<h1>UserPermissionsFacade - Running!!</h1>";
    }
}
