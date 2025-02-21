<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $roles = Role::all();

        return view('index', compact('users', 'roles'));
    }

}
