<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    public function dashboard()
    {
        return view('agent.dashboard');
    }

    public function index()
{
    $loggedInUserId = auth()->id();
    $users = User::with('roles')
                 ->whereHas('roles', function ($query) {
                     $query->where('name', 'customer');
                 })
                 ->where('id', '!=', $loggedInUserId)
                 ->paginate(10);

    return view('agent.users.index', compact('users'));
}

}
