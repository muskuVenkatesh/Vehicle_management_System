<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // Get the logged-in user ID
        $loggedInUserId = auth()->id();

        // Fetch users excluding the logged-in user
        $users = User::with('roles')
                     ->where('id', '!=', $loggedInUserId)
                     ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function AdminDashboard()
    {
        $totalUsers = User::count();
        return view('admin.dashboard', compact('totalUsers'));
    }

    public function show($id)
{
    $user = User::with('roles')->find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return response()->json([
        'name' => $user->name,
        'email' => $user->email,
        'roles' => $user->roles->pluck('name')->toArray(),
    ]);
}


    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'phone' => 'nullable'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone
        ]);

        $user->assignRole($request->role);

        // return redirect()->route('users.index')->with('success', 'User Created Successfully');
        return response()->json([
            'message' => 'User successfully created!'
        ], 200);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->roles()->detach();
        $user->syncRoles($request->role);

        // return redirect()->route('users.index')->with('success', 'User Updated Successfully');
        return response()->json([
            'message' => 'User updated successfully!'
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }


    public function getAllUsers()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }
}
