<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'permissions'])->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('users', 'roles', 'permissions'));
    }

    public function assignPermissions(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($request->has('role')) {
            $user->syncRoles([$request->role]);
        }

        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Permissions & Roles assigned successfully!');
    }

}
