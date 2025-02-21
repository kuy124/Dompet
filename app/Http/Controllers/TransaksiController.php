<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $transactions = Transaction::with(['user', 'recipient']);

    if (auth()->user()->role_id == 3) {
        $transactions = $transactions->where('user_id', auth()->user()->id);
    }

    $transactions = $transactions->paginate(15);
    
    $users = User::all();
    $roles = Role::all();

    return view('transaction', compact('users', 'roles', 'transactions'));
}

}
