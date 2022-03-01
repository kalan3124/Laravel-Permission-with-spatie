<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.role_user_permission')
            ->with([
                "dummy" => config('dummydata.permission_data'),
                "roles" => config('dummydata.roles'),
            ]);
    }

    public function assign(Request $request)
    {
        $role = $request->role;
        $post_permissions = $request->permissions['post_permissions'];
        $logged = Auth::user()->id;

        $role = Role::find($role);
        foreach ($post_permissions as $key => $val) {
            if ($val['status']) {
                $role->givePermissionTo($val['name']);
            } else {
                $role->revokePermissionTo($val['name']);
            }
        }

        if (!Auth::user()->hasRole($role)) {
            $user = User::find($logged);
            $user->assignRole($role);
        }

        return true;
    }

    public function revoke()
    {
        # code...
    }
}
