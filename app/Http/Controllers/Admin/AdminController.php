<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function index()
    // {
    //     $users = User::with('roles')->get();
    //     return view('admin.users.index', compact('users'));
    // }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getAllUsers()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }
}
